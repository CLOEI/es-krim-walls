<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;
    protected $table = 'product_out';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stalls_id',
        'products_id',
        'carton',
        'pcs',
        'date',
    ];

    /**
     * Get the stall that owns the ProductOut.
     */
    public function stall()
    {
        return $this->belongsTo(Stall::class, 'stalls_id');
    }

    /**
     * Get the product that owns the ProductOut.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
