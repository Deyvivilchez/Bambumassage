<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portada_Slider extends Model
{
    use HasFactory;
    protected $table = 'slider_portadas';
    protected $primaryKey = 'portada_id';
    public $timestamps = false;
}
