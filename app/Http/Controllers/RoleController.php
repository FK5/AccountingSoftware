<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $rules = [
            'name' => 'max:255',
            'slug' => 'max:255',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        Role::create($data);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $permissions = Permission::all()->forget([4,5,6,7]);
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $rules = [
            'name' => 'max:255',
            'slug' => 'max:255',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $role->update($data);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $role->delete();
        return redirect()->route('roles.index');
    }

    public function delete(Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        return view('roles.delete', ['role'=>$role]);
    }

    public function attachPermission(Request $request, Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $role->permissions()->attach($request->permission_id);
        return redirect()->back();
    }
    public function detachPermission(Request $request, Role $role)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $role->permissions()->detach($request->permission_id);
        return redirect()->back();
    }
}
