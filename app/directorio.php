<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Directorio extends Model{
    protected $table = "directorios";

    protected $fillable=[
        "nombre_completo",
        "direccion",
        "telefono",
        "url_foto"
    ];

    //para ocultar las columnas created_at y updated_at 
    protected $hidden=["created_at","updated_at"];
}