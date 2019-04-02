<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	// Primary key
	Public $primaryKey = 'category_id';
	// Add a timestamp
	public $timestamps = true;
	// Related to product model
	public function products(){
		return $this->belongsToMany('App\Product', 'category_product', 'categroy_id_fk', 'product_id_fk');
	}
	}
