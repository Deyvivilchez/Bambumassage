<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamaciones;
use App\Models\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Exception;

class LibroReclamacionesController extends Controller
{
    public function index()
    {
        //   return response()->json(LibroReclamaciones::all());

        $sql = LibroReclamaciones::select('reclamos.*', 'p.*')
            ->join('personas as p', 'p.id_persona', '=', 'reclamos.id_persona')
            ->paginate(10);
        return   $sql;
    }
    public function buscarReclamos($texto, $cantidad = 10)
    {
        $query = LibroReclamaciones::select('reclamos.*', 'p.*')
            ->join('personas as p', 'p.id_persona', '=', 'reclamos.id_persona');

        if (!empty($texto)) {
            $query->where(function ($q) use ($texto) {
                $q->where('reclamos.codigo_reclamo', 'LIKE', "%{$texto}%")
                    ->orWhere('reclamos.tipo_reclamo', 'LIKE', "%{$texto}%")
                    ->orWhere('reclamos.detalle', 'LIKE', "%{$texto}%")
                    ->orWhere('reclamos.pedido', 'LIKE', "%{$texto}%")
                    ->orWhereRaw("CONCAT_WS(' ', p.nombres, p.apellido_paterno, p.apellido_materno, p.num_documento) LIKE ?", ['%' . $texto . '%']);
            });
        }

        return $query->paginate($cantidad);
    }

    // public function store(Request $request)
    // {
    //     $persona = Persona::where('num_documento', $request->dni_ruc)->first();

    //     if (!$persona) {

    //         $persona = Persona::create([
    //             'num_documento' => $request->dni_ruc,
    //             'nombres' => $request->solo_nombres,
    //             'apellido_paterno' => $request->ap_paterno,
    //             'apellido_materno' => $request->ap_materno,
    //             'direccion' => $request->direccion,
    //             'celular' => $request->telefono,
    //             'correo' => $request->email,

    //         ]);
    //     }

    //     $longitud = strlen($request->num_documento);

    //     if ($longitud == 8) {
    //         $tipo_documento = 'DNI';
    //     } elseif ($longitud == 11) {
    //         $tipo_documento = 'RUC';
    //     } elseif ($longitud == 9) {
    //         $tipo_documento = 'Carné de Extranjería';
    //     } elseif ($longitud >= 12) {
    //         $tipo_documento = 'Pasaporte';
    //     } else {
    //         $tipo_documento = 'OTRO';
    //     }

    //     // print($persona->id_persona);
    //     // Crear el reclamo con la persona asociada
    //     $reclamo = LibroReclamaciones::create([
    //         'id_persona' => $persona->id_persona,
    //         'tipo_documento' => $tipo_documento,
    //         'num_documento' => $request->dni_ruc,
    //         'detalle' => $request->detalle,
    //         'estado' => 'pendiente',
    //         'fecha_reclamo' => date('Y-m-d H:i:s'), // Formato correcto para MySQL
    //         'producto_servicio' => $request->prod_serv,
    //         'tipo_reclamo' => $request->tipo,

    //     ]);

    //     return response()->json([
    //         'message' => 'Reclamo registrado con éxito',
    //         'codigo_reclamo' => $reclamo->codigo
    //     ], 201);
    // }

    public function store(Request $request)
    {
        try {
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
                    'id_tipo_documento' => 1,

                ]);
            }

            $persona->update([
                'direccion' => $request->direccion, // Corregido
                'celular' => $request->telefono,
                'correo' => $request->email, // Corregido
            ]);

            $longitud = strlen($request->dni_ruc);

            // Eliminar posibles espacios al inicio y final
            $num_documento = trim($request->dni_ruc);

            // Validar si el número de documento tiene solo dígitos
            if (!ctype_digit($num_documento)) {
                return response()->json(['error' => 'El número de documento debe contener solo dígitos.'], 400);
            }

            // Determinar el tipo de documento basado en la longitud
            if ($longitud === 8) {
                $tipo_documento = 'DNI';
            } elseif ($longitud === 11) {
                $tipo_documento = 'RUC';
            } elseif ($longitud === 9) {
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
                'estado' => 'PRESENTADO',
                'fecha_reclamo' => date('Y-m-d H:i:s'), // Formato correcto para MySQL
                'producto_servicio' => $request->prod_serv,
                'tipo_reclamo' => $request->tipo,
                'pedido' => $request->pedido,
                'monto' => $request->monto,

            ]);

            // Envío de correos
            // Envío de correos
            //  $empresaEmail = 'ventas@snackcrocantitos.com'; // Cambia esto por el correo de la empresa
            //  $empresaEmail = 'deyvivilchez@gmail.com'; // Cambia esto por el correo de la empresa

            //  $clienteEmail = $persona->correo;
            //  $codigoReclamo = $reclamo->codigo_reclamo;
            //  $urlConsulta = url("/libro-reclamaciones/$codigoReclamo"); // URL para consultar reclamo

            // Enviar correo a la empresa
            //  Mail::to($empresaEmail)->send(new ReclamoRegistrado($reclamo, 'empresa', $urlConsulta));
            // Enviar correo al reclamante
            //  Mail::to($clienteEmail)->send(new ReclamoRegistrado($reclamo, 'cliente', $urlConsulta));

            return response()->json([
                'message' => 'Reclamo registrado con éxito',
                'reclamo' => $reclamo,
                'codigo_reclamo' => $reclamo->codigo_reclamo
            ], 201);
        } catch (Exception $e) {
            return response()->json(['verificado' => false, 'tipo' => 'error', "mensaje" => "Error: " . $e->getMessage()], 500);
        }
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

    public function respoder_reclamo(Request $request)
    {
        try {
            $reclamo = LibroReclamaciones::findOrFail($request->id_reclamo);
            $reclamo->fecha_respuesta = $request->fecha;
            $reclamo->respuesta = $request->respuesta;
            $reclamo->estado = 'REVISADO';
            $reclamo->update();

            return response()->json(['response' => true, 'message' => 'Reclamo respondido con éxito', 'reclamo'=> $reclamo], 200);
        } catch (\Exception $e) {
            return response()->json(['response' => false, 'error' => 'Error al responder el reclamo', 'message' => $e->getMessage()], 500);
        }
    }
     public function resolver_reclamo(Request $request)
    {
        try {
            $reclamo = LibroReclamaciones::find($request->id_reclamo);
            $reclamo->fecha_acuerdo_final = $request->fechaFinalizacion;
            $reclamo->acuerdo_final = $request->acuerdoFinal;
            $reclamo->estado = 'FINALIZADO';
            $reclamo->save();
            return response()->json([ 'response' => true, 'reclamo'=>$reclamo, 'message' => 'Reclamo respondido con éxito'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al responder el reclamo', 'message' => $e->getMessage()], 500);
        }
    }
}
