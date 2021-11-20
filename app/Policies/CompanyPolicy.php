<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;


class CompanyPolicy
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
                if($permission->id == Permission::CAN_READ_COMPANY){
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Company $company)
    {

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
        //IF WEBMASTER OPERATES 1 OR MORE COMPANY
        //ASSUMED HE CREATED ONE  {CAN BE IMPROVED AND ADD A FIELD IF HE CREATED}
        $company_created = Company::where('user_id',$user->id)->count();
        if($user->role->id == Role::IS_COMPANY_WEBMASTER && $company_created > 0){
            return false;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_CREATE_COMPANY){
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Company $company)
    {
        //IF SUPER ADMIN
        if($user->id==1){
            return true;
        }
        //IF ROLE HAS PERMISSION
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_EDIT_COMPANY){
                    //IF COMPANY WEBMASTER ASSIGNED
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER && $company->user_id != $user->id){
                        return false;
                    }else{
                        return true;
                    }
                    // return true;   
                }
            }
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Company $company)
    {
        if($user->id==1){
            return true;
        }
        $role = $user->role;
        if(!empty($role)){
            $permissions = $role->permissions;
            foreach($permissions as $permission){
                if($permission->id == Permission::CAN_DELETE_COMPANY){
                    if($role->id == ROLE::IS_COMPANY_WEBMASTER && $company->user_id != $user->id){
                        return false;
                    }else{
                        return true;
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Company $company)
    {
        //
    }
}
