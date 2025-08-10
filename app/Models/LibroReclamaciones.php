<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibroReclamaciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reclamos';
    protected $primaryKey = 'id_reclamo';

    protected $fillable = [
        'id_persona',
        'codigo_reclamo',
        'tipo_documento',
        'num_documento',
        'detalle',
        'estado',
        'fecha_reclamo',
        'producto_servicio',
        'tipo_reclamo',  
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reclamo) {
            // Generar el código único para el reclamo (Ej: RCL-000001)
            $ultimoCodigo = static::latest()->first();
            $reclamo->codigo_reclamo = 'LRC-' . str_pad(($ultimoCodigo ? (intval(substr($ultimoCodigo->codigo_reclamo, 4)) + 1) : 1), 6, '0', STR_PAD_LEFT);
        });
        // static::creating(function ($reclamo) {
        //     // Bloquea la consulta para evitar conflictos en concurrencia
        //     $ultimoCodigo = static::lockForUpdate()->latest('id_reclamo')->first();
    
        //     $nuevoNumero = $ultimoCodigo ? (intval(substr($ultimoCodigo->codigo_reclamo, 4)) + 1) : 1;
    
        //     $reclamo->codigo_reclamo = 'RCL-' . str_pad($nuevoNumero, 6, '0', STR_PAD_LEFT);
        // });
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }



}
