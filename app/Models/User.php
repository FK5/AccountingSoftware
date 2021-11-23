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

    
    public function role (){
        return $this->belongsTo(Role::class);
    }

    public function companies(){
        return $this->belongsToMany(Company::class);
    }

    public function isManager(){
        if($this->role->id == Role::IS_MANAGER){
            return true;
        }else{
            return false;
        }
    }
    public function isWebMaster(){
        if($this->role->id == Role::IS_COMPANY_WEBMASTER){
            return true;
        }else{
            return false;
        }
    }
    public function isOfficer(){
        if($this->role->id == Role::IS_COMPANY_OFFICER){
            return true;
        }else{
            return false;
        }
    }
}
