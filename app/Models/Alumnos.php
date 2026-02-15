<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class alumnos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'alumnos';
    protected $fillable = [
        "matricula",
        "nombre",
        "apellido_p",
        "apellido_m",
        "fecha_nacimiento",
        "telefono",
        "carrera",
        "email",
        "contraseña",
        "curriculumn",
        "genero"
    ];
}
