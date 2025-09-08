<?php



namespace App\Http\Controllers;



use App\Models\Salas;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class SalonController extends Controller

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
       $sala= new Salas;
       $destinoimagen='salas/';
       if ($request->hasFile('imagen')){
           $file= $request->file("imagen");
           $nombrearchivo  =  Str::slug(
            $file->getClientOriginalName() .
            "-" . date("Y-m-d H:i:s")) . 
            "." . $file->guessExtension();
           $file->move(public_path($destinoimagen),$nombrearchivo);
           $sala->imagen = $nombrearchivo;
           $sala->id_sede = $input['id_sede'];
           $sala->save();
            return response()->json(["create_sala"=>true]);
         // echo json_encode(['estado' => true]);

       }else{

        return response()->json(["create_sala"=>false]);
      //  return response()->json(["create_sala"=>false]);

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

    public function destroy($id)

    {

        //

    }

    public function list_salon_sede(Request $request){



        $input=$request->all();
        $list_salones = Salas::where("id_sede","=", $input['id_sede'])->get();
        echo json_encode(['list_salones' => $list_salones]);

    }

    public function eliminar_Sala(Request $request){



            $input=$request->all();

            $Salas = Salas::find( $input['id_foto']);

            $Salas->delete();

            echo json_encode(['mensaje' => '¡Registro eliminado correctamente!']);



    }

}

