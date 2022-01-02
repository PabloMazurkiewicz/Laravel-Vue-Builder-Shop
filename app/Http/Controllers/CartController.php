<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function add(Product $product, $quantity)
    {
        $unique_micro_timestamp = intval(\microtime(true)*10000); //it is unique cart id
        $product_ids = \Cart::getContent()->map( fn($item) => $item->associatedModel->id );

        if( !$product_ids->contains($product->id) ) { //item could be added to cart only once
            \Cart::add(array(
                'id' => $unique_micro_timestamp,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'attributes' => array(),
                'associatedModel' => $product
            ));
        }
    }

    public function show()
    {
        return view('cart', [
            'items' => \Cart::getContent()
        ]);
    }
}
