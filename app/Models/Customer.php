<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'email',
        'phone',
        'mobile',
        'address',
        'company_id',
    ];
    

    public function getBalanceAttribute()
    {
        $balance = 0;
        $invoice_balance = Invoice::where('customer_id',$this->id)->sum('total');
        $payment_balance = Payment::where('customer_id',$this->id)->sum('amount');
        return $payment_balance-$invoice_balance;
    }   
}
