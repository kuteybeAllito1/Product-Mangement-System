<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Auth;
class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->firstOrCreate([]);
        $cart->load('items.product');
        return view('cart.index', compact('cart'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantity'=>'nullable|integer|min:1'
        ]);
        $cart = Auth::user()->cart()->firstOrCreate([]);
        $item = $cart->items()->firstOrNew([
            'product_id' => $request->product_id
        ]);
        $item->quantity += $request->quantity ?? 1;
        $item->save();
        return back()->with('success','The product has been added to the cart.');
    }
    public function update(Request $request, CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) abort(403);
        $request->validate(['quantity'=>'required|integer|min:1']);
        $item->update(['quantity'=>$request->quantity]);
        return back()->with('success','Quantity updated.');
    }
    public function remove(CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) abort(403);
        $item->delete();
        return back()->with('success','Item deleted.');
    }
}
