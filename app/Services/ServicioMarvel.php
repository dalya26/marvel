<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
/**
 * Class ServicioMarvel.
 */
class ServicioMarvel
{
    //metodos protegidos
    protected $dburl; //almacena la url de la bd de la api de marvel
    protected $publicKey;//almacena la clave publica para autenticarse con la api de marvel 
    protected $privateKey;//almacena la clave privada para autenticarse con la api de marvel

    //constructor que inicializa los metodos, estableciendo la url de la bd e inicializando las clave publica y privada
    public function __construct(){
        $this->dburl = 'https://gateway.marvel.com:443/v1/public/';
        $this->publicKey = config('services.marvel.public_key');
        $this->privateKey = config('services.marvel.private_key');
    }

    //funcion para obtener la lista de personajes del API, recibe dos parametros el cual name realizar busquedas y filtrarla nombres. offset permite paginar los resultados de los personajes
    public function getPersonajes($name = null, $offset = 0){


        //generacion de la url para llamar a la api de marvel
        $ts = time();
        //generacion de un hash mediante el timestamp, publickey y privatekey para autenticar la solicitud de la api de marvel
        $hash = md5($ts . $this->privateKey . $this->publicKey);
        //url completa con clave publica, tiempo, el hash
        $url = $this->dburl . 'characters?apikey=' . $this->publicKey . '&ts=' . $ts . '&hash=' . $hash . '&offset=' . $offset;

        //filtro de la busqueda por el nombre del personaje
        if ($name) {
            $url .= '&nameStartsWith=' . $name;
        }
        
        //se realiza una consulta http de tipo get y retorna los datos de los personajes de marvel en formato json
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json()['data']['results'];
        }

        //si la consulta falla retorna un array basio
        return [];
    }

}