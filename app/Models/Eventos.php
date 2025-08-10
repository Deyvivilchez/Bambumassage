<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eventos extends Model
{
    use HasFactory;
    protected $table = "eventos";
    protected $primaryKey = "id_evento";
    use SoftDeletes;

    public function Inscritos(){
        return  $this->hasMany(
            DetalleEventos::class,
         'id_evento',
          'id_evento');
    }
}
