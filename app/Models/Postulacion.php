<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postulacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'postulaciones';
    protected $fillable = [
        "id",
        "alumno_id",
        "vacante_id",
        "estatus"
    ];

    function usuario(){
        return $this->belongsTo(Alumno::class , 'alumno_id');
    }

    function vacante(){
        return $this->belongsTo(Vacantes::class , 'vacante_id');
    }

    function empres(){
        return $this->belongsTo(Empresa::class , 'empresa_id');
    }
}
