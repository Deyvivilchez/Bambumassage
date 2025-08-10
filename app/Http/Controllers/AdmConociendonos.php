<?php



namespace App\Http\Controllers;



use App\Models\Conociendonos;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdmConociendonos extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $conociendonos = Conociendonos::all();

       echo json_encode(['conociendonos' => $conociendonos]);

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

        //

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

    public function update(Request $request)

    {

        $input = $request->all();

        // var_dump($input);

         $cod = $input['id'];

         $conociendonos =Conociendonos::find($cod);

         $conociendonos->descripcion = $input['descripcion'];

        // $conociendonos->autor = $input['autor'];

         $destinoimagen='web/images/inicio/';



         if($input['imagen'] == 0){

             $conociendonos->update();

             echo json_encode(['mensaje' => '¡Registro Actualizado correctamente!']);

         }else{

             if ($request->hasFile('imagen')){

                 $file= $request->file('imagen');

                 $nombrearchivo  = $file->getClientOriginalName();

                 $file->move(public_path($destinoimagen),$nombrearchivo);

                 $conociendonos->imagen = $nombrearchivo;

                 $conociendonos->update();

                 echo json_encode('Actualizacion Exitosa');

             }else{

                 echo json_encode('Error en el Registro ');

             }

            }





    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

}

