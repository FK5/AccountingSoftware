<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Company::class);
        $user_role = Auth::user()->role;
        if(!empty($user_role)){
            if($user_role->id == Role::IS_COMPANY_WEBMASTER){
                $companies = Company::all()->where('user_id',Auth::user()->id);
            }else{
                $companies = Company::all();
            }
        }else{
            $companies = Company::all();
        }
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Company::class);
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Company::class);
        $user=Auth::user();
        $rules = [
            'company_name' => 'required|max:255',
            'legal_name' => 'required|max:255',
            'business_id' => 'required|max:255',
            'company_email' => 'required|max:255|email',
            'company_phone_number' => 'required|max:255',
            'company_address' => 'required|max:255',
            'industry' => 'required|max:255',
            'website' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        if(!$request->has('approved'))$approved=false;else$approved=true;
        $data = $request->all();
        $data['approved']= $approved;
        
        $latest = Company::create($data);
        if($user->role->id == Role::IS_COMPANY_WEBMASTER){
            $latest->user_id = $user->id;
        }
        $latest->save();
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        $this->authorize('update',$company);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        $this->authorize('update',$company);
        $rules = [
            'company_name' => 'required|max:255',
            'legal_name' => 'required|max:255',
            'business_id' => 'required|max:255',
            'company_email' => 'required|max:255|email',
            'company_phone_number' => 'required|max:255',
            'company_address' => 'required|max:255',
            'industry' => 'required|max:255',
            'website' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        if(!$request->has('approved'))$approved=false;else$approved=true;
        $data = $request->all();
        $data['approved']= $approved;

        $company->update($data);
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        $this->authorize('delete',$company);
        $company->delete();
        return redirect()->route('companies.index');
    }

    public function delete(company $company)
    {
        $this->authorize('delete',$company);
        return view('companies.delete', ['company'=>$company]);
    }
}
