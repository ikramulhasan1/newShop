<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->with('sub_category')
            ->orderBy('id', 'DESC')
            // ->with('products')
            ->where('status', 1)
            ->where('showHome', 'Yes')
            ->get();

        $cartItems = Cart::instance('cart')->content();
        return view('frontend.cart', compact('categories', 'cartItems'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $price = $product->price ? $product->price : $product->compare_price;
        Cart::instance('cart')->add($product->id, $product->title, $product->qty, $product->price)->associate('App\Models\Product');
        return redirect()->route('front.cart', compact('price'));
    }
}
