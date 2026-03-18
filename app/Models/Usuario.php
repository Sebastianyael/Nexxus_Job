<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'usuarios';
    protected $fillable = [
        "id",
        "nombre",
        "apellido_p",
        "apellido_m",
        "email",
        "telefono",
        "contraseña",
        "fecha_nacimiento",
        "genero",
        "tipo"
    ]; 

    
}
