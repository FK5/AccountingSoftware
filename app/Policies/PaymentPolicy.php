<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;

class PaymentPolicy
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
                if($permission->id == Permission::CAN_READ_INVOICE){
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Payment $payment)
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
                if($permission->id == Permission::CAN_CREATE_INVOICE){
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Payment $payment)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_INVOICE){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get('id');
                        $customers = Customer::whereIn('company_id',$companies)->get('id');
                        $payments = Payment::whereIn('customer_id',$customers)->get();
                        foreach($payments as $payment_in_array){
                            if($payment_in_array->id == $payment->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies->pluck('id');
                        $customers = Customer::whereIn('company_id',$companies)->get('id');
                        $payments = Payment::whereIn('customer_id',$customers)->get();
                        foreach($payments as $payment_in_array){
                            if($payment_in_array->id == $payment->id){
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Payment $payment)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_INVOICE){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get('id');
                        $customers = Customer::whereIn('company_id',$companies)->get('id');
                        $payments = Payment::whereIn('customer_id',$customers)->get();
                        foreach($payments as $payment_in_array){
                            if($payment_in_array->id == $payment->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies->pluck('id');
                        $customers = Customer::whereIn('company_id',$companies)->get('id');
                        $payments = Payment::whereIn('customer_id',$customers)->get();
                        foreach($payments as $payment_in_array){
                            if($payment_in_array->id == $payment->id){
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Payment $payment)
    {
        //
    }
}
