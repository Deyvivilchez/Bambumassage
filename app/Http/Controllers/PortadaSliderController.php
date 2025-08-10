<?php



namespace App\Http\Controllers;



use App\Models\Portada_Slider;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PortadaSliderController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $portada_Slider=Portada_Slider::all();

        echo json_encode(['portada_slider' => $portada_Slider]);

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

     * @param  \App\Models\Portada_Slider  $portada_Slider

     * @return \Illuminate\Http\Response

     */

    public function show(Portada_Slider $portada_Slider)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Models\Portada_Slider  $portada_Slider

     * @return \Illuminate\Http\Response

     */

    public function edit(Portada_Slider $portada_Slider)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Models\Portada_Slider  $portada_Slider

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request)

    {

        $imput = $request->all();

        $id_portada=$imput['id_portada'];

        $portada =Portada_Slider::find($id_portada);





      //  print_r($imput);



        $destinoimagen='portadas';



        if ($request->hasFile('imagen_portada')){

            $file= $request->file("imagen_portada");

            $nombrearchivo  =  Str::slug($file->getClientOriginalName() . "-"
             . date("F j, Y, g , i , a")) .
              "." . $file->guessExtension();
            $file->move(public_path($destinoimagen),$nombrearchivo);

            $portada->portada_imagen = $nombrearchivo;

            $portada->update();

            echo json_encode('Actualizacion Exitosa');

        }else{

            echo json_encode('Error en el Registro ');

        }



    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Models\Portada_Slider  $portada_Slider

     * @return \Illuminate\Http\Response

     */

    public function destroy(Portada_Slider $portada_Slider)

    {

        //

    }

}

