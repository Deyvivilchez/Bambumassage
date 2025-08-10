<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategoria extends Model
{
    use SoftDeletes;

    protected $table = 'faqs_categoria';

    protected $fillable = ['descripcion'];

    // Relación: Una categoría tiene muchas subcategorías
    public function subcategorias()
    {
        return $this->hasMany(FaqSubcategoria::class, 'id_categoria');
    }

    public function faqsDirectos()
    {
        return $this->hasMany(Faq::class, 'id_categoria')->whereNull('id_subcategoria');
    }
}
