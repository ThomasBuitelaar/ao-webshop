<?php

namespace App;
use Log;
use Session;

class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct() {
        if (Session::has('cart')) {
            if (Session::get('cart')->totalQty <= 0) {
                Session::forget('cart');
            } else {
                $this->items = Session::get('cart')->items;
                $this->totalQty = Session::get('cart')->totalQty;
                $this->totalPrice = Session::get('cart')->totalPrice;
            }
        }
    }


    public function calculateQtyAndPrice() {
        $this->totalQty = 0;
        $this->totalPrice = 0;
        foreach($this->items as $item) {
            $this->totalQty += $item['qty'];
            $this->totalPrice += ($item['qty'] * $item['price'] * (100 - $item['item']->product_discount_percentage)/100);
            //$this->totalPrice += ($item['qty'] * $item['price']);
        }
    }


    // Add a product to the shopping cart
    public function add($item, $id) {
        error_log("Inside add function");
        $itemPrice = $item->product_price;
        // Calculate discounted price  
        if ($item->product_discount_precentage !== null) {
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
//HUH        $storedItem['price'] = $itemPrice * $storedItem['qty'];
        $this->items[$id] = $storedItem;
//HUH        $this->totalQty++;
//HUH        $this->totalPrice += $itemPrice;
        $this->calculateQtyAndPrice();
        Session::put('cart', $this);    
    }

    // Remove items from the cart
    public function remove($item, $id, $removeAll) {
        error_log("start remove");
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
        error_log("totalQty = ". $this->totalQty);

        if ($removeAll === true) {
//HUH            $itemPrice = $itemPrice * $storedItem['qty'];
//HUH            $this->totalQty -= $storedItem['qty'];
//HUH            $this->totalPrice -= $itemPrice;
            unset($this->items[$id]);
        }
        else {
            $storedItem['qty']--;
//HUH            $storedItem['price'] = $itemPrice * $storedItem['qty'];
            $this->items[$id] = $storedItem;
//HUH            $this->totalQty--;
//HUH            $this->totalPrice -= $itemPrice;
            if ($storedItem['qty'] <= 0) {
                unset($this->items[$id]);
            }
        }
        $this->calculateQtyAndPrice();
        Session::put('cart', $this);
    }
}

