<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
        public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all(); 
        return view('users.index', compact('users','roles'));
    }

    public function attachRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->roles()->syncWithoutDetaching([$request->role_id]);
        return back()->with('success','Role attached to user!');
    }

    public function detachRole(User $user, Role $role)
    {
        $user->roles()->detach($role->id);
        return back()->with('success','Role detached from user!');
    }

        public function makeSeller($id)
    {
        $user = User::findOrFail($id);
        $roleSeller = Role::where('name','seller')->first();
        if($roleSeller){
            $user->roles()->syncWithoutDetaching([$roleSeller->id]);
        }
        return redirect()->route('users.index')->with('success','User promoted to Seller.');
    }

    // makeUser
    public function makeUser($id)
    {
        $user = User::findOrFail($id);
        $roleUser = Role::where('name','user')->first();
        if($roleUser){
            $user->roles()->sync([$roleUser->id]);
        }
        return redirect()->route('users.index')->with('success','User role changed to User.');
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $roleAdmin = Role::where('name','admin')->first();
        if($roleAdmin){
            $user->roles()->syncWithoutDetaching([$roleAdmin->id]);
        }
        return redirect()->route('users.index')->with('success','User role changed to Admin.');
    }
}
