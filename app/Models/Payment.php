<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentItems;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'payment_date',
        'payment_method',
        'amount',
    ];

    /**
     * Get all of the items for the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(PaymentItems::class);
    }

    public function getRemainingAttribute()
    {
        $payment_items = PaymentItems::where('payment_id',$this->id)->sum('amount');
        return $this->amount-$payment_items;
    } 
}
