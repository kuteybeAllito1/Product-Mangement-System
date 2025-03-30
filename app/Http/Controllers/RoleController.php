<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name'
        ]);
        Role::create([
            'name'=>$request->name,
            'is_super_admin'=>$request->has('is_super_admin')
        ]);
        return back()->with('success','Role created successfully!');
    }

    public function attachPermission(Request $request, Role $role)
    {
        $request->validate([
            'permission_id'=>'required|exists:permissions,id'
        ]);
        $role->permissions()->syncWithoutDetaching([$request->permission_id]);
        return back()->with('success','Permission attached!');
    }

    public function detachPermission(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission->id);
        return back()->with('success','Permission detached!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success','Role deleted!');
    }
}
