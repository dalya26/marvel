<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;

    //nombre de la tabla de la base de datos que se utiliza 
    protected $table = "personajes";
    
    //atributos asignados
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
    ];
}
