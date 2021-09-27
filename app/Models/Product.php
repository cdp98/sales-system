<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'reference',
        'price'
    ];

    public function providers()
    {
        return $this->belongsToMany(
            \App\Models\Provider::class,
            $tableName= 'product_providers',
            $currentModelField = 'product_id',
            $joinedModelField = 'provider_id'
        );
    }
}
