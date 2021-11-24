<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Company;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Customer::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        //IF SUPER ADMIN GET ALL COMPANIES
        if($user_id == 1){
            $customers = Customer::all();
        }else{
            //IF WEBMASTER GET PRODUCTS OWNED BY COMPMNY THAT WEBMASTER BELONGS TO
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get('id');
                $customers = Customer::whereIn('company_id',$companies)->get();
            }
            //IF OFFICER GET PRODUCTS OWNED BY COMPMNY THAT OFFICER ASSIGNED TO
            elseif($role->id == $user->isOfficer()){
                $companies = $user->companies->pluck('id');
                $customers = Customer::whereIn('company_id',$companies)->get();
            }
        }
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Customer::class);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;
        
        if($user_id == 1){
            $companies = Company::all();
        }else{
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get();
            }
            if($role->id == $user->isOfficer()){
                $companies = $user->companies;
            }
        }
        return view('customers.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Customer::class);
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'mobile' => 'max:255',
            'address' => 'required|max:255',
            'company_id' => 'required|not in:Open this select menu',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        Customer::create($data);
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        $this->authorize('update',$customer);
        $user = Auth::user();
        $user_id = $user->id;
        $role = Auth::user()->role;

        if($user_id == 1){
            $companies = Company::all();
        }else{
            if($role->id == $user->isWebMaster()){
                $companies = Company::where('user_id', $user_id)->get();
            }
            if($role->id == $user->isOfficer()){
                $companies = $user->companies;
            }
        }
        return view('customers.edit',compact('customer','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        $this->authorize('update',$customer);
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'mobile' => 'max:255',
            'address' => 'required|max:255',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $customer->update($data);
        $customer->save();
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete',$customer);
        $customer->delete();
        return redirect()->route('customers.index');
    }

    public function delete(Customer $customer)
    {
        $this->authorize('delete',$customer);
        return view('customers.delete', ['customer'=>$customer]);
    }
}
