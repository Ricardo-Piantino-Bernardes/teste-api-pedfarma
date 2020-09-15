<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'id_product', 'id_client'
    ];

    public const RELATIONSHIP_PROVIDER_CLIENT = 'sales';

    public function products()
    {
        return $this->belongsToMany(Product::class, self::RELATIONSHIP_PROVIDER_CLIENT, 'id_product', 'id_client');
    }
}
