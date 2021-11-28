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
        'notes',
        'discount',
        'subtotal',
        'total',
    ];

    /**
     * Get all of the items for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }
    
    protected $appends = ['amount_unpaid'];

    public function getAmountUnpaidAttribute()
    {
        $payment_items = PaymentItems::where('invoice_id',$this->id)->sum('amount');
        return $this->total-$payment_items;
    } 
}
