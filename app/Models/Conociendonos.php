<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conociendonos extends Model
{
    use HasFactory;
    protected $table = 'conociendonos';
   protected $primaryKey = 'id_conociendonos';
   public $timestamps = false;
}
