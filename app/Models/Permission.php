<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public const CAN_READ_COMPANY = 1;
    public const CAN_CREATE_COMPANY = 2;
    public const CAN_EDIT_COMPANY = 3;
    public const CAN_DELETE_COMPANY = 4;
    public const CAN_READ_USER = 5;
    public const CAN_CREATE_USER = 6;
    public const CAN_EDIT_USER = 7;
    public const CAN_DELETE_USER = 8;
    public const CAN_READ_CUSTOMER = 9;
    public const CAN_CREATE_CUSTOMER = 10;
    public const CAN_EDIT_CUSTOMER = 11;
    public const CAN_DELETE_CUSTOMER = 12;
    public const CAN_READ_PRODUCT = 13;
    public const CAN_CREATE_PRODUCT = 14;
    public const CAN_EDIT_PRODUCT = 15;
    public const CAN_DELETE_PRODUCT = 16;
    public const CAN_READ_INVOICE = 17;
    public const CAN_CREATE_INVOICE = 18;
    public const CAN_EDIT_INVOICE = 19;
    public const CAN_DELETE_INVOICE = 20;
    public const CAN_READ_PAYMENT = 21;
    public const CAN_CREATE_PAYMENT = 22;
    public const CAN_EDIT_PAYMENT = 23;
    public const CAN_DELETE_PAYMENT = 24;
    

    /**
     * The roles that belong to the permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
