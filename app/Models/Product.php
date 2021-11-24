<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'sku',
        'category_id',
        'company_id',
        'sales_price',
        'cost',
    ];

    public function invocies(){
        return $this->belongsToMany(Invoice::class)->withPivot('quantity');
    }
}
