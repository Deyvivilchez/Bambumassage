<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamaciones;
use App\Models\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LibroReclamacionesController extends Controller
{
    public function index()
    {
        return response()->json(LibroReclamaciones::all());
    }

    public function store(Request $request)
    {
        $persona = Persona::where('num_documento', $request->dni_ruc)->first();

        if (!$persona) {

            $persona = Persona::create([
                'num_documento' => $request->dni_ruc,
                'nombres' => $request->solo_nombres,
                'apellido_paterno' => $request->ap_paterno,
                'apellido_materno' => $request->ap_materno,
                'direccion' => $request->direccion,
                'celular' => $request->telefono,
                'correo' => $request->email,
                
            ]);
        }

        $longitud = strlen($request->num_documento);

        if ($longitud == 8) {
            $tipo_documento = 'DNI';
        } elseif ($longitud == 11) {
            $tipo_documento = 'RUC';
        } elseif ($longitud == 9) {
            $tipo_documento = 'Carné de Extranjería';
        } elseif ($longitud >= 12) {
            $tipo_documento = 'Pasaporte';
        } else {
            $tipo_documento = 'OTRO';
        }

        // print($persona->id_persona);
        // Crear el reclamo con la persona asociada
        $reclamo = LibroReclamaciones::create([
            'id_persona' => $persona->id_persona,
            'tipo_documento' => $tipo_documento,
            'num_documento' => $request->dni_ruc,
            'detalle' => $request->detalle,
            'estado' => 'pendiente',
            'fecha_reclamo' => date('Y-m-d H:i:s'), // Formato correcto para MySQL
            'producto_servicio' => $request->prod_serv,
            'tipo_reclamo' => $request->tipo,

        ]);

        return response()->json([
            'message' => 'Reclamo registrado con éxito',
            'codigo_reclamo' => $reclamo->codigo
        ], 201);
    }



    public function show($codigo)
    {
        $reclamo = LibroReclamaciones::where('codigo_reclamo', $codigo)->first();
    
        if ($reclamo) {
            return response()->json([
                'existe' => true,
                'detalle' => $reclamo
            ]);
        } else {
            return response()->json([
                'existe' => false,
                'mensaje' => 'El código ingresado no existe.'
            ], 404);
        }
    }
    

    public function update(Request $request, $id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);
        $reclamo->update($request->all());
        return response()->json(['message' => 'Reclamo actualizado correctamente']);
    }

    public function destroy($id)
    {
        LibroReclamaciones::findOrFail($id)->delete();
        return response()->json(['message' => 'Reclamo eliminado']);
    }
    public function mostrarComprobante($codigo)
    {
        $reclamo = LibroReclamaciones::where('codigo_reclamo', $codigo)->first();
    
        if (!$reclamo) {
            return abort(404, 'Reclamo no encontrado');
        }
    
        return view('web.comprobanteReclamo', compact('reclamo'));
    }


        public function descargarComprobante($codigo)
        {
          //  $reclamo = LibroReclamaciones::where('codigo_reclamo', $codigo)->first();

          $reclamo = LibroReclamaciones::join('personas', 'reclamos.id_persona', '=', 'personas.id_persona')
                ->where('reclamos.codigo_reclamo', $codigo)
                ->select('reclamos.*', 'personas.*') // Selecciona las columnas que necesitas
                ->first();

       //return $reclamo  ;

            if (!$reclamo) {
                return abort(404, 'Reclamo no encontrado');
            }

            $pdf = Pdf::loadView('web.comprobanteReclamoPdf', compact('reclamo'));
            return $pdf->stream("Comprobante_Reclamo_$codigo.pdf");
        }

    
   
}
