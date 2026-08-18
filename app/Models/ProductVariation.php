<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variations';

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'price',
        'old_price',
        'stock_qty',
        'sku',
        'is_default',
    ];

    /**
     * Get the product that owns this variation.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
