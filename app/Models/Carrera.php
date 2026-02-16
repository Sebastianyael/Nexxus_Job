<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Carrera extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'carreras';
    protected $fillable = [
        "id",
        "nombre",
    ]; 
}
