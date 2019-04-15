<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
        // Primary Key
    public $primaryKey = 'client_id';
    // Timestamps
    public $timestamps = true;
    // Relate to category modal
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
