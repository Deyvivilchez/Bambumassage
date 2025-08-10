<?php



namespace App\Http\Controllers;



use App\Models\Sede;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class SedesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

    }

    public function listaSedes(){



        $sedes = DB::table('sedes')->get();

        echo json_encode(['sedes' => $sedes]);

    }





    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $input=$request->all();



        $sede= new Sede;

        $sede->sede=$input['nombre'];

        $sede->direccion=$input['direccion'];

        $sede->telefono1=$input['celular'];

        $sede->link_w=$input['link'];

        // $sede->imagen=$input['imagen'];

        $sede->mapa=$input['mapa'];



        $destinoimagen='web/images/img_sedes/';



        if ($request->hasFile('imagen')){

            $file= $request->file("imagen");
            $nombrearchivo  =  Str::slug(
     $file->getClientOriginalName(). 
            "-" . date("Y-m-d H:i:s")) .
            "." . $file->guessExtension();
            $file->move(public_path($destinoimagen),$nombrearchivo);
            $sede->imagen = $nombrearchivo;
            $sede->save();
            return response()->json([ 'create_sala' => true]);

        }else{
            return response()->json([ 'create_sala' => false]);
           // echo json_encode('Error en el Registro ');

        }

    }

    public function actualizar_img_sede(Request $request){



        $input=$request->all();

        $destinoimagen='web/images/img_sedes/';

        $update_sede = Sede::find($input['id_sede']);

        if ($request->hasFile('imagen_sede')){

            $file= $request->file("imagen_sede");

            $nombrearchivo  =  Str::slug($file->getClientOriginalName() .
             "-" .date("Y-m-d H:i:s")) 
             . "." . $file->guessExtension();

            $file->move(public_path($destinoimagen),$nombrearchivo);

            $update_sede->imagen = $nombrearchivo;

            $update_sede->save();

            echo json_encode('Registro existoso');

        }else{

            echo json_encode('Error en el Registro ');

        }



    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function editar_sede(Request $request){



         $input=$request->all();

            //  print_r($input);

            $update_sede = Sede::find($input['id_sede']);

            $update_sede->sede=$input['sede_nombre'];

            $update_sede->direccion=$input['direccion'];

            $update_sede->telefono1=$input['celular'];

            $update_sede->link_w=$input['link'];

            $update_sede->mapa=$input['mapa'];

            $update_sede->save();



         //   print_r($update_sede);



        echo json_encode("Registro Actualizado");





    }

    public function destroy(Request $request)

    {

         $input=$request->all();

         $sede = Sede::find($input['id_sede']);

         $sede->delete();

         echo json_encode("Registro eliminado");

    }



}

