<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_name',
        'legal_name',
        'business_id',
        'company_email',
        'company_phone_number',
        'company_address',
        'industry',
        'website',
        'approved',
    ];

    // public function users()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }

    // public function products()
    // {
    //     return $this->hasMany('App\Models\Product_Service');
    // }
}
