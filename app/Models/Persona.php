<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
 

    use HasFactory, SoftDeletes;

    protected $table = 'personas';
    protected $primaryKey = 'id_persona';

    protected $fillable = [
        'num_documento',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'direccion',
        'sexo',
        'celular',
        'correo',
        'foto',
        'estado_civil'
    ];

    public function reclamos()
    {
        return $this->hasMany(LibroReclamaciones::class, 'id_persona', 'id_persona');
    }
  
}
