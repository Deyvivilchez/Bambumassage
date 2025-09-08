<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqSubcategoria extends Model
{
    use SoftDeletes;

    protected $table = 'faqs_subcategoria';

    protected $fillable = ['descripcion', 'id_categoria'];

    // Relación: Subcategoría pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(FaqCategoria::class, 'id_categoria');
    }

    // Relación: Una subcategoría tiene muchas preguntas
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'id_subcategoria');
    }
}
