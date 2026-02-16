<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'alumnos';
    protected $fillable = [
        "matricula",
        "curriculum",
        "carrera_id",
        "usuario_id"
    ];

    

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}
