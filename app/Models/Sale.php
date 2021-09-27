<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'address_delivery',
        'total_price',
        'sale_date'
    ];

    public function products()
    {
        return $this->belongsToMany(
            \App\Models\Product::class,
            $tableName= 'sale_products',
            $currentModelField = 'sale_id',
            $joinedModelField = 'product_id'
        );
    }
}
