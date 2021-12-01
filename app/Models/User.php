<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'date_of_birth',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relations Functions
    public function role (){
        return $this->belongsTo(Role::class);
    }

    public function companies(){
        return $this->belongsToMany(Company::class);
    }
    //Role Check Functions
    public function isManager(){
        return $this->role->id == Role::MANAGER;
    }
    public function isWebMaster(){
        return $this->role->id == Role::COMPANY_WEBMASTER;
    }
    public function isOfficer(){
        return $this->role->id == Role::COMPANY_OFFICER;
    }
    //Get permissions
    public function getPermissions(){
        $role = $this->role;
        return !empty($role) ? $role->permissions : [];
    }

    //Check permission
    public function checkPermission($permission){
        if($this->id==1){
            return true;
        }
        $user_permissions = $this->getPermissions(); 
        foreach ($user_permissions as $user_permission) {
            if($user_permission->id == $permission)
                return true;
        }
        return false;
    }
}
