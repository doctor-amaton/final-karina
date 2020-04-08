<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
    	$place_id = $request['place_id'];
    	$name = $request['name']; //?: 160; //in KM
        $formatted_address = $request['formatted_address'];
        $rating = $request['rating'];
        $lat = $request['lat'];
        $lng = $request['lng'];
    }

    public function add()
    {
		$sql = "Insert into places (location,radius,type,keyword,fields) ";
		$sql .= "value (\"$this->location\",\"$this->radius\",\"$this->type\",\"$this->keyword\",\"$this->fields\")";
		Executor::doit($sql);
	}
}
