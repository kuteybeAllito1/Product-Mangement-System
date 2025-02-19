<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function makeSeller($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'seller';
        $user->save();
        return redirect()->route('users.index')->with('success','User promoted to Seller.');
    }

    public function makeUser($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();
        return redirect()->route('users.index')->with('success','User role changed to User.');
    }
}
