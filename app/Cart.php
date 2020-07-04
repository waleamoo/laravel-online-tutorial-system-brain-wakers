<?php

namespace App;

class Cart
{
    public $items = null; // items in the cart: group of products - that has product inside it
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items; // check if the items array is empty and recreate the items
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;

        }
    }
    public function add($item, $id){
        $storedItem = ['qty' => 0, 'price'=> $item->fee, 'item' => $item]; // group
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
                return false;
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->fee * $storedItem['qty'];
        $this->items[$id] = $storedItem; // add the storedItem to the items array 
        $this->totalQty++;
        $this->totalPrice += $item->fee;
    }

    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
