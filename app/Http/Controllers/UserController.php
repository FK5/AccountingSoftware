<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::all()->slice(1);
        $roles = Role::all();
        return view('users.index',compact('users', 'roles'));
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
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'max:255|email|unique:users',
            'gender' => 'in:male,female,other',
            'date_of_birth' => 'date',
            'status' => 'in:approved,pending,blocked',
            
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        if($data['role_id']=='Open this select menu')$data['role_id']=null;
        $data['password'] = Hash::make($data['password']);
        $date = now();
        $user = User::create($data);
        $user->status = $request->status;
        $user->email_verified_at = $date;
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user();
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $user = User::findorFail($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        // if (! Gate::allows('super-admin',$user_id)) {
        //     abort(403);
        // }
        $rules = [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'max:255|email',
            'gender' => 'in:male,female,other',
            'date_of_birth' => 'date',
            'status' => 'in:approved,pending,blocked',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::findorFail($id);
        $user->update($data);
        if(isset($request->status))$user->status = $request->status;
        if(isset($data['role_id']) && $data['role_id'] != 'Open this select menu')$user->role_id = $data['role_id'];
        $user->save();
        if($user->id==1)
        return redirect()->route('users.index');
        else
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $user_id = Auth::user()->id;
        if (! Gate::allows('super-admin',$user_id)) {
            abort(403);
        }
        $user = User::findOrFail($id);
        return view('users.delete', ['user'=>$user]);
    }

    public function profile()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }
}
