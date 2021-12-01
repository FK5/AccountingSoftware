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
        return $user->checkPermission(Permission::CAN_READ_COMPANY);
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
        if($user->id==1) return true;
        $user_permissions = $user->getPermissions();
        foreach ($user_permissions as $user_permission) {
            switch ($user_permission->id) {
                case Permission::CAN_CREATE_ONE_COMPANY:
                    $companies_created = Company::where('user_id',$user->id)->count();
                    return $companies_created > 0 ? false : true;
                    break;
                case Permission::CAN_CREATE_COMPANY:
                    return true;
                    break;
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
        if($user->id==1) return true;
        $user_permissions = $user->getPermissions();
        foreach ($user_permissions as $user_permission) {
            switch ($user_permission->id) {
                case Permission::CAN_EDIT_OWN_COMPANY:
                    return Company::where('user_id',$user->id)->contains($company) ? true : false;
                    break;
                case Permission::CAN_EDIT_ASSIGNED_COMPANY:
                    return $user->companies->contains($company) ? true : false;
                    break;
                case Permission::CAN_EDIT_ALL_COMPANY:
                    return true;
                    break;
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
        //IF SUPER ADMIN
        if($user->id==1) return true;
        $user_permissions = $user->getPermissions();
        foreach ($user_permissions as $user_permission) {
            switch ($user_permission->id) {
                case Permission::CAN_DELETE_OWN_COMPANY:
                    return Company::where('user_id',$user->id)->contains($company) ? true : false;
                    break;
                case Permission::CAN_DELETE_ASSIGNED_COMPANY:
                    return $user->companies->contains($company) ? true : false;
                    break;
                case Permission::CAN_DELETE_ALL_COMPANY:
                    return true;
                    break;
            }
        }
        return false;
    }
}
