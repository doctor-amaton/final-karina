<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
    	$place_id = $request["place_id"];
    	$name = $request["name"]; //?: 160; //in KM
        $formatted_address = $request["formatted_address"];
        $rating = $request["rating"];
        $lat = $request["lat"];
        $lng = $request["lng"];

        # Usar la API de Google Maps definida en .env
        $api_key = env("GOOGLE_MAPS_API_KEY", "");

        return view("index", ["api_key" => $api_key]);
    }

    public function add()
    {
		$sql = "Insert into places (location,radius,type,keyword,fields) ";
		$sql .= "value (\"$this->location\",\"$this->radius\",\"$this->type\",\"$this->keyword\",\"$this->fields\")";
		Executor::doit($sql);
	}

    /*public function test(Request $request)
    {
        $latCenter = $request["latCenter"];
        $lonCenter = $request["lonCenter"];
        $latTarget = $request["latTarget"];
        $lonTarget = $request["lonTarget"];
        $distanceKm = $request["distanceKm"];

        if()
        {
            return true
        }
        
    } */

    /**
     * Guardar un nuevo "lugar"
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
