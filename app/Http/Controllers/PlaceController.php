<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
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

        # Lista de tipos de ubicaciones (obtenida por google)
        $types = [
            "accounting",
            "airport",
            "amusement_park",
            "aquarium",
            "art_gallery",
            "atm",
            "bakery",
            "bank",
            "bar",
            "beauty_salon",
            "bicycle_store",
            "book_store",
            "bowling_alley",
            "bus_station",
            "cafe",
            "campground",
            "car_dealer",
            "car_rental",
            "car_repair",
            "car_wash",
            "casino",
            "cemetery",
            "church",
            "city_hall",
            "clothing_store",
            "convenience_store",
            "courthouse",
            "dentist",
            "department_store",
            "doctor",
            "drugstore",
            "electrician",
            "electronics_store",
            "embassy",
            "fire_station",
            "florist",
            "funeral_home",
            "furniture_store",
            "gas_station",
            "grocery_or_supermarket",
            "gym",
            "hair_care",
            "hardware_store",
            "hindu_temple",
            "home_goods_store",
            "hospital",
            "insurance_agency",
            "jewelry_store",
            "laundry",
            "lawyer",
            "library",
            "light_rail_station",
            "liquor_store",
            "local_government_office",
            "locksmith",
            "lodging",
            "meal_delivery",
            "meal_takeaway",
            "mosque",
            "movie_rental",
            "movie_theater",
            "moving_company",
            "museum",
            "night_club",
            "painter",
            "park",
            "parking",
            "pet_store",
            "pharmacy",
            "physiotherapist",
            "plumber",
            "police",
            "post_office",
            "primary_school",
            "real_estate_agency",
            "restaurant",
            "roofing_contractor",
            "rv_park",
            "school",
            "secondary_school",
            "shoe_store",
            "shopping_mall",
            "spa",
            "stadium",
            "storage",
            "store",
            "subway_station",
            "supermarket",
            "synagogue",
            "taxi_stand",
            "tourist_attraction",
            "train_station",
            "transit_station",
            "travel_agency",
            "university",
            "veterinary_care",
            "zoo",
        ];

        # Usar la API de Google Maps definida en .env
        $api_key = env("GOOGLE_MAPS_API_KEY", "");

        return view("index", ["api_key" => $api_key, "types" => $types]);
    }

    public function add()
    {
		$sql = "Insert into places (location,radius,type,keyword,fields) ";
		$sql .= "value (\"$this->location\",\"$this->radius\",\"$this->type\",\"$this->keyword\",\"$this->fields\")";
		Executor::doit($sql);
	}

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

    /**
     * Encontrar las ubicaciones cercanas al centro
     * a una distancia de N kilometros
     *
     * @param Request $request Peticion, con la latitud y longitud, asi como el keyword y el tipo de ubicacion
     * @return JSON            Con las ubicaciones obtenidas de la base de datos (no repetidos)
     */
    public function locate(Request $request)
    {
        # Obtener la latitud, longitud, nombre de la ubicacion y tipo de ubicacion
        $keyword = $request->input("keyword", null);
        $type = $request->input("type", null);
        $radius = $request->input("radius", 30);

        # Por defecto nos vamos al centro del Tec Laguna
        $lat  = $request->input("lat", 25.535365);
        $lon  = $request->input("lon", -103.435297);

        # Aqui realizaremos la consulta remota, hay que validar todos los campos
        try {
            if (empty($keyword)) throw new ValidationException("No se especifico un nombre de ubicacion");

            $result = array(
                0 =>
                array (
                  'lat' => 25.5401941,
                  'lng' => -103.4555456,
                  'name' => 'MARTE - cocina•café•espacio',
                  'formatted_address' => 'Av Matamoros 585, Primero de Cobián Centro, Torreón',
                ),
                1 =>
                array (
                  'lat' => 25.5429247,
                  'lng' => -103.4495288,
                  'name' => 'La Ofrenda Concept Store y Café',
                  'formatted_address' => 'Rayon 184, Constancia, Torreón',
                ),
                2 =>
                array (
                  'lat' => 25.5618731,
                  'lng' => -103.4193519,
                  'name' => 'BellaCuba.17',
                  'formatted_address' => '27010, Río Mayo 1090, Magdalenas, Torreón',
                ),
                3 =>
                array (
                  'lat' => 25.5385499,
                  'lng' => -103.457478,
                  'name' => 'Cafetería Desayunos Ligeros',
                  'formatted_address' => 'Benito Juárez 774, Centro, Torreón',
                ),
                4 =>
                array (
                  'lat' => 25.5411782,
                  'lng' => -103.4522119,
                  'name' => 'Cafe y Bar Tumbao',
                  'formatted_address' => 'Av Allende 255, Primero de Cobián Centro, Torreón',
                ),
                5 =>
                array (
                  'lat' => 25.542092,
                  'lng' => -103.4471459,
                  'name' => 'Mongolian Restaurante Oriental',
                  'formatted_address' => 'Av Abasolo 124-5, Primero de Cobián Centro, Torreón',
                ),
                6 =>
                array (
                  'lat' => 25.5399143,
                  'lng' => -103.4434472,
                  'name' => 'Bondi',
                  'formatted_address' => 'Calle García Carrillo #126, Primero de Cobián Centro, Torreón',
                ),
                7 =>
                array (
                  'lat' => 25.5788081,
                  'lng' => -103.4033758,
                  'name' => 'Sausalito Café',
                  'formatted_address' => 'Blvrd Independencia 3080, Residencial el Fresno, Torreón',
                ),
                8 =>
                array (
                  'lat' => 25.5389242,
                  'lng' => -103.4484662,
                  'name' => 'Kingans',
                  'formatted_address' => 'Calz Cristobal Colón 245, Segundo de Cobián Centro, Torreón',
                ),
                9 =>
                array (
                  'lat' => 25.5348531,
                  'lng' => -103.4230313,
                  'name' => 'Pronto Restaurante Torreón Jardín',
                  'formatted_address' => 'Plaza Santa Maria, Blvrd Revolución 2360, Torreón Jardín, Torreón',
                ),
                10 =>
                array (
                  'lat' => 25.5335762,
                  'lng' => -103.4186436,
                  'name' => 'Casa de mi Abuela',
                  'formatted_address' => 'Av. Citlatepetl 790, Torreón Jardín, Torreón',
                ),
                11 =>
                array (
                  'lat' => 25.5438511,
                  'lng' => -103.4497064,
                  'name' => 'Soul & Balanzze Centro',
                  'formatted_address' => 'Rayon 287, Primero de Cobián Centro, Torreón',
                ),
                12 =>
                array (
                  'lat' => 25.5686486,
                  'lng' => -103.4244197,
                  'name' => 'Kingans',
                  'formatted_address' => 'Blvrd Independencia 2295, San Isidro, Torreón',
                ),
                13 =>
                array (
                  'lat' => 25.544015,
                  'lng' => -103.4542875,
                  'name' => 'Mar y Tierra',
                  'formatted_address' => 'Av. Escobedo 453, Centro, Torreón',
                ),
                14 =>
                array (
                  'lat' => 25.5595575,
                  'lng' => -103.433072,
                  'name' => 'Gourmet Cimaco',
                  'formatted_address' => 'Blvrd Independencia 1300, Navarro, Torreón',
                ),
                15 =>
                array (
                  'lat' => 25.5478508,
                  'lng' => -103.4535769,
                  'name' => 'Cochinita pibil',
                  'formatted_address' => 'Amp los Ángeles, Torreón',
                ),
                16 =>
                array (
                  'lat' => 25.5420857,
                  'lng' => -103.4508491,
                  'name' => 'Gorditas y comida corrida Mary',
                  'formatted_address' => 'Av Abasolo 123, Primero de Cobián Centro, Torreón',
                ),
                17 =>
                array (
                  'lat' => 25.5417303,
                  'lng' => -103.453836,
                  'name' => 'Pa\' Asarla Agusto',
                  'formatted_address' => 'Calle Ramón Corona 37, Primero de Cobián Centro, Torreón',
                ),
                18 =>
                array (
                  'lat' => 25.5456097,
                  'lng' => -103.4549027,
                  'name' => 'D\' Enrique',
                  'formatted_address' => 'Av Simon Bolívar 517, Moderna, Torreón',
                ),
                19 =>
                array (
                  'lat' => 25.5813063,
                  'lng' => -103.4033344,
                  'name' => 'Sushi Itto Galerias',
                  'formatted_address' => 'Galerías Laguna Local 149, Periferico Raul Lopez Sanchez 6000, Residencial el Fresno, Torreón',
                ),
            );

            # code here
            return response()->json(["results" => $result]);


        } catch (ValidationException $exception) {
            return response()->json(["message" => $exception->getMessage()], $exception->getCode());

        } catch (\Exception $exception) {

        }

    }
}
