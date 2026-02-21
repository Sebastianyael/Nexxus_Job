<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ubicacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ubicaciones';
    protected $fillable = [
        "id",
        "cp",
        "colonia",
        "municipio",
        "estado",
    ];
}
