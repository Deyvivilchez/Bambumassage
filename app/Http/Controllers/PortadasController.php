<?php



namespace App\Http\Controllers;



use App\Models\Portadas;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class PortadasController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $portadas = Portadas::all();

        echo json_encode(['portadas' => $portadas]);

    }

    public function actualizarP(Request $request)

    {

        //Comentarios $comentarios

        $input = $request->all();

       // print_r($input);

        $cod = $input['id_portada'];

        $portada =Portadas::find($cod);

        $destinoimagen='web/images/portadas/';

        if ($request->hasFile('imagen_portada')){

            $file= $request->file("imagen_portada");

            $nombrearchivo  =  Str::slug($file->getClientOriginalName() .
             "-" . date("Y-m-d H:i:s")) . 
             "." . $file->guessExtension();
            
            $file->move(public_path($destinoimagen),$nombrearchivo);

            $portada->imagen = $nombrearchivo;

            $portada->update();

            echo json_encode('Actualizacion Exitosa');

        }else{

            echo json_encode('Error en el Registro ');

        }

    }

    // public function listaSedes(){



    //     $sedes = DB::table('sedes')->get();

    //     echo json_encode(['sedes' => $sedes]);

    // }

}

