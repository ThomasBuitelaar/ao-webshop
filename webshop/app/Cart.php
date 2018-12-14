<?php

namespace App;

class Cart
{
    public $item = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->item = $oldCart->items;
            $this->totalQtf= $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
   

    public function add($item, $id){
        $itemPrice = $item->price;
        
        $storedItem = ['qty' => 0, 'price' => $itemPrice, 'item'=> $item, 'id' =>$id];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->item[$id];
            }
        }

        $storedItem['qty']++;
        
        $this->item[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $newPrice;
    }
}
