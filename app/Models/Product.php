<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barcode',
        'name',
        'ppc',
        'stocks_id',
        'prices_id',
    ];

    /**
     * Get the stock associated with the product.
     */
    public function stock()
    {
        return $this->hasOne(Stock::class, 'id', 'stocks_id');
    }

    /**
     * Get the price associated with the product.
     */
    public function price()
    {
        return $this->hasOne(Price::class, 'id', 'prices_id');
    }
}
