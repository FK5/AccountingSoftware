<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_READ_CUSTOMER){
                    return true;   
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //IF SUPER ADMIN
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_CREATE_CUSTOMER){
                    return true;   
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Customer $customer)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_CUSTOMER){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get('id');
                        $customers = Customer::whereIn('company_id',$companies)->get();
                        foreach($customers as $customer_in_array){
                            if($customer_in_array->id == $customer->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies->pluck('id');
                        $customers = Customer::whereIn('company_id',$companies)->get();
                        foreach($customers as $customer_in_array){
                            if($customer_in_array->id == $customer->id){
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Customer $customer)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_CUSTOMER){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get('id');
                        $customers = Customer::whereIn('company_id',$companies)->get();
                        foreach($customers as $customer_in_array){
                            if($customer_in_array->id == $customer->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies->pluck('id');
                        $customers = Customer::whereIn('company_id',$companies)->get();
                        foreach($customers as $customer_in_array){
                            if($customer_in_array->id == $customer->id){
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Customer $customer)
    {
        //
    }
}
