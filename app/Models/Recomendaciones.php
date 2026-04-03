<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recomendaciones extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'recomendaciones';
    protected $fillable = [
        'instructor_id',
        'alumnos_id',
        'comentario'
    ];

    public function alumnoInfo(){
        return $this->belongsTo(Alumno::class , 'alumnos_id');
    }

    public function instructorInfo(){
        return $this->belongsTo(Instructor::class , 'instructor_id');
    }

  
}
