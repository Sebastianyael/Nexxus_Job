<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table =  'instructores';
    protected $fillable = [
        "nombre",
        "apellido_p",
        "apellido_m",
        "no_empleado",
        "telefono",
        "email",
        "contraseña",
        "cargo",
        "fecha_nacimiento"
    ]; 

}
