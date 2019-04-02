<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Primary Key
    public $primaryKey = 'order_id';
    // Timestamps
    public $timestamps = true;
    // Relate to Product modal
    public function products(){
    	return $this->belongsToMany('App\Product', 'order_product', 'order_id_fk', 'product_id_fk')->withPivot('quantity', 'price');
    }
}
