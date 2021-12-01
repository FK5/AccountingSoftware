<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
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
        $user = Auth::user();
        $user_role = Auth::user()->role;
        if(!empty($user_role)){
            switch ($user_role->id) {
                case Role::MANAGER:
                    $companies = Company::all();
                    break;
                case Role::COMPANY_WEBMASTER:
                    $companies = Company::all()->where('user_id',Auth::user()->id);
                    break;
                case Role::COMPANY_OFFICER:
                    $companies = $user->companies;
                    break;
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
        $users = User::where('role_id',Role::COMPANY_WEBMASTER)->orWhereNull('role_id')->get()->forget(1);
        return view('companies.create', compact('users'));
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
            'business_id' => 'required|unique:companies|max:255',
            'company_email' => 'required|max:255|email',
            'company_phone_number' => 'required|max:255',
            'company_address' => 'required|max:255',
            'industry' => 'required|max:255',
            'website' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        if(!empty($user->role)){
            if($user->role->id == Role::COMPANY_WEBMASTER){
                $data['user_id']= $user->id;
            }
        }
        if(!empty($data['user_id'])){
            $user_id = $data['user_id'];
            $user = User::findOrFail($user_id);
            if(empty($user->role)){
                $user->role_id = Role::COMPANY_WEBMASTER;
                $user->save();
            }
        }
        Company::create($data);
        return redirect()->route('companies.index');
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
        $users = User::where('role_id',Role::COMPANY_WEBMASTER)->orWhereNull('role_id')->get()->forget(1);
        return view('companies.edit', compact('company','users'));
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
        $data = $request->all();
        if(!empty($data['approved']) && $data['approved']=='on')$data['approved']=1;
        if(!empty($data['user_id'])){
            $user_id = $data['user_id'];
            $user = User::findOrFail($user_id);
            if(empty($user->role) && $user->id != 1){
                $user->role_id = Role::COMPANY_WEBMASTER;
                $user->save();
            }
        }
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

    public function assign(Company $company)
    {
        $this->authorize('update',$company);
        $users = User::where('role_id',Role::COMPANY_OFFICER)->get();
        return view('companies.assign', compact('company','users'));
    }

    public function attachOfficer(Request $request, Company $company)
    {
        $company->users()->attach($request->user_id);
        return redirect()->back();
    }
    public function detachOfficer(Request $request, Company $company)
    {
        $company->users()->detach($request->user_id);
        return redirect()->back();
    }
}
