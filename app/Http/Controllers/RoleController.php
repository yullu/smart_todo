<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(5);
        return view('roles.index',compact('roles'));

    }
    public function create()
    {
        return view('roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles',
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();

        return redirect()->route('roles')->with('success','Role created successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit',compact('role'));

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('roles')->with('success','Role deleted successfully');
    }
}
