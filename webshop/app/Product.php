<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// Primary Key
    public $primaryKey = 'product_id';
    // Timestamps
    public $timestamps = true;
    // Relate to category modal
    public function categories(){
    	return $this->belongsToMany('App\Category', 'category_product', 'product_id_fk', 'category_id_fk');
    }
    // Relate to order modal
    public function orders(){
    	return $this->belongsToMany('App\Order', 'order_product', 'product_id_fk', 'order_id_fk')->withPivot('quantity', 'price');
    }
}
