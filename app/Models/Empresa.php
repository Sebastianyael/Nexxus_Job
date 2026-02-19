<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{   
    use HasFactory;
    use SoftDeletes;
    protected $table = 'empresas';
    protected $fillable = [
        "nombre",
        "giro",
        "telefono",
        "email",
        "contraseña",
        "calle",
        "ubicacion_id",
    ]; 
}
