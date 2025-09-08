<?php



namespace App\Http\Controllers;



use App\Models\Promociones;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class AdmPromocionesController extends Controller

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



    public function listaPromociones(){
        $promociones = Promociones::all();
        echo json_encode(['promociones' => $promociones]);

    }

    public function actualizarPromociones(Request  $request){

        $input = $request->all();
         $cod = $input['id_promocion'];
         $promociones =Promociones::find($cod);
         $promociones->nombre = $input['descripcion'];
         $promociones->link = $input['link'];
         $destinoimagen='web/images/';
         if($input['img'] == 0){
             $promociones->update();
             echo json_encode(['mensaje' => '¡Registro Actualizado correctamente!']);
         }else{
             if ($request->hasFile('img')){
                 $file= $request->file('img');
                 $nombrearchivo  =  Str::slug( 
                $file->getClientOriginalName() .
                "-" . date("F j, Y, g , i , a")) .
                "." . $file->guessExtension();
                $file->move(
                    public_path(
                    $destinoimagen),
                    $nombrearchivo);
                $promociones->imagen = $nombrearchivo;
                $promociones->update();
                return response()->json_encode(['respuesta',true]);
             }else{
                 return response()->json_encode(['respuesta',false]);
             }





         }



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

        $promociones = Promociones::all();

        echo json_encode(['promociones' => $promociones]);

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

    public function destroy($id)

    {

        //

    }

}

