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

    /**
     * Guardar un nuevo 'lugar'
     *
     * @param  Request $request Petición, debería tener la información formateada para ser almacenada inmediatamente
     * @return HTTP Response [200, 400, 500]
     */
    public function save(Request $request)
    {
        # Respuesta simple
        return response()->json([
            "result" => 42
        ]);
    }
}
