<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portadas extends Model
{
    use HasFactory;
    protected $table = 'portadas';
   protected $primaryKey = 'id_portada ';
   public $timestamps = false;
}
