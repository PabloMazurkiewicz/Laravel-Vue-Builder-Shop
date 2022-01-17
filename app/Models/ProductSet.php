<?php

namespace App\Models;

use App\Contracts\Purchaseable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSet extends Model implements Purchaseable
{
    use HasFactory;
    public $timestamps = false;

    protected $appends = ['products_json', 'inCart'];

    public function getInCartAttribute() :bool
    {
        return false;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_set_product');
    }

    public function getProductsJsonAttribute()
    {
        return $this->products;
    }

    public static function whereContainsProduct(Product $product) :Builder
    {
        return ProductSet::whereHas('products', function ($query) use ($product) {
            $query->where('products.id', $product->id);
        });
    }
}
