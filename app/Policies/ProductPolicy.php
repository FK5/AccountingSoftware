<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;

class ProductPolicy
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
                if($permission->id == Permission::CAN_READ_PRODUCT){
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Product $product)
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
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_CREATE_PRODUCT){
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Product $product)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_PRODUCT){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get();
                        $products = Product::whereIn('company_id',$companies)->get();
                        foreach($products as $product_in_array){
                            if($product_in_array->id == $product->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies;
                        $products = Product::whereIn('company_id',$companies)->get();
                        foreach($products as $product_in_array){
                            if($product_in_array->id == $product->id){
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Product $product)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_DELETE_PRODUCT){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER){
                        $companies = Company::where('user_id', $user->id)->get();
                        $products = Product::whereIn('company_id',$companies)->get();
                        foreach($products as $product_in_array){
                            if($product_in_array->id == $product->id){
                                return true;
                            }
                        }
                    }elseif($role->id == ROLE::IS_COMPANY_OFFICER){
                        $companies = $user->companies;
                        $products = Product::whereIn('company_id',$companies)->get();
                        foreach($products as $product_in_array){
                            if($product_in_array->id == $product->id){
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
