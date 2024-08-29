<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIn extends Model
{
    use HasFactory;
    protected $table = 'product_in';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'products_id',
        'quantity',
        'price',
        'date',
    ];

    /**
     * Get the product that owns the ProductIn.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
