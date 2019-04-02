<?php

namespace App;
use Session

class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function__construct()
    {
        if (Session::has('cart')) {
            if (Session::get('cart')->totalQty <= 0) {
                Session::forget('cart');
            }else{
                // Possibly put the following in an object. (joost)
                $this->items = Session::get('cart')->items;
                $this->totalQty = Session::get('cart')->totalQty;
                $this->totalPrice = Session::get('cart')->totalPrice;
            }
        }
    }

// Add a product to the shopping cart
public function add($item, $id){
    $itemPrice = $item->product_price;
    // Calculate discounted price
    if ($item->product_discount_precentage !== null){
        $itemPrice = $itemPrice - ($itemPrice * ($item->product_discount_percentage/100));
    }
    // Array where the items in the cart will be stored
    $storedItem = ['qty' => 0, 'price' => $itemPrice, 'item'=> $item];
if ($this->items){
    if (array_key_exists($id, $this->items)) {
        $storedItem = $this->items[$id];
    }
}
$storedItem['qty']++;
$storedItem['price'] = $itemPrice *  $storedItem['qty'];
$this->items[$id] = $storedItem;
$this->totalQty++;
$this->totalPrice += $itemPrice;
Session::put('cart', $this);
}

// Remove items from the cart
public function remove($item, $id, $removeAll) {
    $itemPrice = $item->product_price;
//Calculating discount price again
 if ($item->product_discount_percentage !== null) {
        $itemPrice = $itemPrice - ($itemPrice * ($item->product_discount_percentage/100));
    }
$storedItem = ['qty' => $this->items[$id]['qty'], 'price' => $this->items[$id]['price'], 'item' => $item];
if ($this->items) {
    if (array_key_exists($id, $this->items)) {
        $item = $this->items[$id];
    }
}

// Removing all or one product form the cart
if($removeAll == true) {
    $itemPrice = $itemPrice * $storedItem['qty'];
    $this->totalPrice -= $itemPrice;
    if ($stopredItem['qty'] <= 0) {
        unset($this->item[$id]);
    }
}
Session::put('cart', $this);
}
}

