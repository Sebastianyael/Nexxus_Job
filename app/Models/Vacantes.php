<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacantes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'vacantes';
    protected $fillable = [
        "id",
        "requisitos",
        "fecha_de_publicacion",
        "fecha_de_expiracion",
        "descripcion",
        "titulo",
        "empresa_id",
        "genero",
        "tiempo",
        "modalidad",
        "jornada"
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class , 'empresa_id');
    }
}
