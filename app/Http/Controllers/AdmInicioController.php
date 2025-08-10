<?php



namespace App\Http\Controllers;



use App\Models\SliderInicio;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class AdmInicioController extends Controller

{

    public function logeo(Request $request)
    {
        session_start();
        $input = $request->all();
        $usuario = $input['usuario'];
        $clave = $input['clave'];
        $respuesta = DB::select('SELECT *
                                FROM usuarios
                                WHERE usuario="' . $usuario . '"  and clave="' . $clave . '"');
        $cantidad = count($respuesta);
        $_SESSION['usuario'] = $respuesta[0]->usuario;
        if ($cantidad != 0) {
            echo json_encode(1);
            // return redirect()->route('/administracion');
        } else {
            echo json_encode('Clave o usuario incorrecto',);
        }
    }

    public function index()

    {
        $sliderInicio = SliderInicio::all();
        echo json_encode(['sliderInicio' => $sliderInicio]);
    }

    public function actualizarImgSlider(Request $request)
    {

        $input = $request->all();
        $id_producto = $input['id_slider'];
        $slider = SliderInicio::find($id_producto);
        $destinoimagen = 'web/images/inicio/';
        if ($request->hasFile('slider_img')) {
            $file = $request->file("slider_img");
            $nombrearchivo  =  Str::slug($file->getClientOriginalName() . 
            "-" .  date("|Y-m-d H:i:s")) . 
            "." . $file->guessExtension();
            $file->move(public_path($destinoimagen), $nombrearchivo);
            $slider->imagen = $nombrearchivo;
            $slider->update();
            return response()->json(['valor' => true]);
        } else {
            return response()->json(['valor' => false]);
        }
    }

    public function salir()
    {

       // unset($_SESSION["usuario"]);
        return redirect('login');
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
