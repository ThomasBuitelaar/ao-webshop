<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;


class CartController extends Controller
{
	// Get shopping cart
    public function getCart() {
        $cart = new Cart();
        if (!$cart) {
            return view('shopping-cart.index');
        }
        return view('shopping-cart.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    // Get add to shopping cart (add id check)
    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->add($product, $product->product_id);
        return redirect()->back();
    }
    // Remove one item shopping cart
    public function removeOneCartItem(Request $request, $id) {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->remove($product, $product->product_id, false);
        return redirect()->back();
    }
    // Remove all same items shopping cart
    public function removeCartItems(Request $request, $id) {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->remove($product, $product->product_id, true);
        return redirect('/shopping-cart');
    }
}
