<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Instructor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'instructores';
    protected $fillable =  [
        "id", 
        "no_empleado",
        "id_puesto",
        "id_usuario"
    ];

    public function usuarios(){
        return $this->belongsTo(Usuario::class ,  'id_usuario');
    }

    public function puesto(){
        return $this->belongsTo(Puesto::class , 'id_puesto');
    }
}
