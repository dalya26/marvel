<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use Illuminate\Http\Request;
use App\Services\ServicioMarvel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonajeController extends Controller
{

    //constructor para el servicio de marvel
    protected $marvelService;

    public function __construct(ServicioMarvel $marvelService)
    {
        $this->marvelService = $marvelService;
    }

    // funcion para mostrar todos los personajes
    public function index()
    {
        $characters = Personaje::paginate(10);//paginacion de los personajes en paginas de 10 en 10
        return view('characters.index', compact('characters'));
    }

    //funcion para devolver la vista del formulario de los personajes
    public function create()
    {
        return view('characters.create');
    }

    //funcion para registrar un nuevo personaje mediante una solicitud post, validando los datos del personaje y guardarlos en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del personaje antes de guardarlos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image',
        ]);

        // Guardar la imagen en el storage enviando el nombre a la base de datos
        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->saveThumbnail($request->file('thumbnail'), 'thumbnails');
        }

        // Crear el personaje con los datos validados
        Personaje::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail,
        ]);

        //redirigirse a la vista de la lista de los personajes
        return redirect()->route('characters.index');
    }

    //funcion para mostrar la vista para editar un personaje
    public function edit(Personaje $character)
    {
        return view('characters.edit', compact('character'));
    }

    public function show(Personaje $character)
    {
        return view('characters.show', compact('character'));
    }

    //funcion para actualizar un personaje, validando los datos actualizados
    public function update(Request $request, Personaje $character)
    {
        //validacion de datos antes de mandarlos a la base de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image',
        ]);

        // guardar la imagen en el storage enviando el nombre a la base de datos
        $thumbnail = $character->thumbnail; // mantener la imagen anterior si no se envia una nueva
        if ($request->hasFile('thumbnail')) {
            // elimina la imagen anterior si se envia una nueva, almacenandola en el storage
            if ($character->thumbnail && \Storage::disk('public')->exists($character->thumbnail)) {
                \Storage::disk('public')->delete($character->thumbnail);
            }
            // guardar la imagen actualizada dentro del storage, en la carpeta publica dentro thumbnails
            $thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Actualizar el personaje
        $character->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail,
        ]);

        //redirigirse a la vista principal donde se muestran todos los personajes
        return redirect()->route('characters.index');
    }

    // funcion para eliminar un personaje
    public function destroy(Personaje $character)
    {
        // eliminar la imagen del almacenada dentro del storage
        if ($character->thumbnail) {
            Storage::disk('public')->delete($character->thumbnail);
        }

        // eliminar el personaje de la base de datos
        $character->delete();

        //redirigir a la vista principal donde se muestran todos los personajes
        return redirect()->route('characters.index');
    }


    //funcion para buscar un personaje por el nombre
    public function search(Request $request)
    {
        //obtener el parametro de la busqueda
        $busqueda = $request->get('busqueda');
        //hacer una consulta a la base de datos en la tabla personajes, selecionando solo el nombre, la descripcion y la imagen
        $characters = DB::table('personajes')->select('name', 'description', 'thumbnail')
            ->where('name', 'LIKE', '%' . $busqueda . '%')//condicion para obtener el valor de la variable busqueda utilizando % para buscar en cualquier parte del name el nombre
            ->orderBy('name', 'asc');//condicion para ordenar de forma ascendente los nombres
            

        return view('characters.index', compact('characters', 'busqueda'));
    }

    //funcion para obtener los personajes de la api de marvel
    public function personajes($offset = 0)
    {
        $characters = $this->marvelService->getPersonajes($offset);
        return view('characters.marvel', compact('characters', 'offset'));
    }

    //funcion para almacenar los personajes de la api en la base de datos
    public function geyCharacters()
    {
        //se hace una llamda al metodo getPersonajes del servico de Marvel para obtener los personajes de la api
        $characters = $this->marvelService->getPersonajes();
        //bucle de iteracion cada personaje obtenido de la api
        foreach ($characters as $character) {

            //construir una url de la imagen del personaje con la extension de la imagen
            $thumbnailUrl = $character['thumbnail']['path'] . '.' . $character['thumbnail']['extension'];

            // descargar y guardar la imagen del personaje en el storage
            $thumbnailPath = $this->saveThumbnail($thumbnailUrl, 'thumbnails');

            //crear o actualizar un personaje, se busca al personaje por el nombre, si existe se actualiza la informacion del personaje, si el nombre no existe crea un nuevo personaje
            Personaje::updateOrCreate(
                ['name' => $character['name']],
                [
                    'description' => $character['description'] ?? '',
                    'thumbnail' => $thumbnailPath,
                ]
            );
        }

        
        return redirect()->route('characters.index');
    }
}
