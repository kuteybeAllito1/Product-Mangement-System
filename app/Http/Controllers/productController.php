<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class productController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where('name', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
    }

    $products = $query->get(); 

    return view('main.home', compact('products'));
}

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('home')->with('success', 'Ürün başarıyla eklendi!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $product->update($request->all());
    return redirect()->route('home')->with('success', 'Ürün başarıyla güncellendi!');
}

    public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('home')->with('success', 'Ürün başarıyla silindi!');
}
}