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
	public function products() {
		return $this->morphToMany('App\Product', 'category_products', 'category_id', 'product_id');
	}
}
