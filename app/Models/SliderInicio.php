<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderInicio extends Model
{
    use HasFactory;
    protected $table = 'slider_inicio';
    protected $primaryKey = 'id_slider_inicio';
    public $timestamps = false;

}
