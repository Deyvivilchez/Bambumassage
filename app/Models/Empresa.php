<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa_datos';
    protected $primaryKey = 'id_empresa_dato';
    public $timestamps = false;
}
