<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Faq extends Model
{
    use SoftDeletes;
    use Searchable;

    protected $table = 'faqs';

    protected $fillable = ['pregunta', 'respuesta', 'id_subcategoria', 'id_categoria'];

    // Relación: La pregunta pertenece a una subcategoría
    public function subcategoria()
    {
        return $this->belongsTo(FaqSubcategoria::class, 'id_subcategoria');
    }

    // Acceso indirecto a la categoría desde la pregunta (opcional)
    public function categoria()
    {
        return $this->belongsTo(FaqCategoria::class, 'id_categoria');
    }

    public function getCategoriaFinalAttribute()
    {
        return $this->categoria ?? $this->subcategoria->categoria ?? null;
    }

    public function toSearchableArray()
    {
        return [
            'pregunta' => $this->pregunta,
            'respuesta' => $this->respuesta,
        ];
    }
}
