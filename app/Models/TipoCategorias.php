<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCategorias extends Model
{
    use HasFactory;
    protected $table= "tipo_categoria";
    protected $primaryKey = "tipo";

    public function categorias(){
        return  $this->hasMany(
            Categorias::class,
         'tipo',
          'tipo');
    }

}
