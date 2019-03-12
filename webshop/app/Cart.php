<?php

namespace App;

class Cart
{
    public $item = null;
    public $totalQty = 0;
    public $totalPrice = 0;

   /* public function __construct($oldCart)
    {
        if($oldCart){
            $this->item = $oldCart->items;
            $this->totalQtf= $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    */
   

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
    }
        public function addItem($id){
        //Get data from session
        $sessionData = Session::all();
        //Put in local items
        $sessionData = $Items
        //Als Items nog leeg is -> ken lege array toe aan local Items
        if($Item = NULL){
            $Item =  array[];
        }
        //Als Id al voor komt in Items -> Bijbehorende ammount ophogen
        elseif($item['id' => NULL]){
            $item = [
                "id" => "",
                "ammount" => "",
            ];
        }
        //Anders -> new cartItem aanmaken
        else{
            $object = new cartItem();
            $object->[
                "id"=>"itemId",
                "ammount"=>"itemAmmount",
            ];
        }
        //En toevoegen aan local Items
        $item=> cartItem();
        //Put items -> session
        Session::put('id', 'item');

        session(['id' => 'item'],['ammount' => 'itemAmmount']);

        }

/**
 * session_start();
 * $cart = array();
 * if(!isset($_SESSION['cart'])) {
 * $_SESSION['cart']} = $cart;
 * }else {
 * array_push($cart,)}
 */
}

