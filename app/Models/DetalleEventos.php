<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleEventos extends Model
{
    use HasFactory;
    protected $table = "detallevento";
    protected $primaryKey = "id_detalleevento";
    use SoftDeletes;
}
