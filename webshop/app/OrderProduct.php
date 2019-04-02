<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    // table name
    protected $table = 'order_product';
    // Timestamps
    public $timestamps = false;
}
