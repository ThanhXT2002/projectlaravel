<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'attribute_id',
    ];

    protected $table = 'product_variant_attribute';

    // // Define relationship to ProductVariant
    // public function product_variant()
    // {
    //     return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    // }

    // // Define relationship to Attribute
    // public function attribute()
    // {
    //     return $this->belongsTo(Attribute::class, 'attribute_id');
    // }
}
