<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
	protected $table = 'places';
     protected $fillable = [
    	'place_id', 'name', 'formatted_address', 'rating', 'lat', 'lng',
    ];
}
