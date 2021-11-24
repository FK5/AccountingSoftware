<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'billing_address',
        'invoice_date',
        'due_date',
        'invoice_number',
        'discount',
        'subtotal',
        'total',
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
