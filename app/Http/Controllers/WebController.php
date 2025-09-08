<?php



namespace App\Http\Controllers;



use App\Models\SliderInicio;

use App\Models\Comentarios;

use App\Models\Conociendonos;

use App\Models\Categorias;

use App\Models\Promociones;

use App\Models\ProductoServicio;

use App\Models\Sede;

use App\Models\Empresa;
use App\Models\Eventos;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class WebController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $sliderIni = SliderInicio::all();
        $comentarios = Comentarios::all();
        $conociendonos = Conociendonos::all();
        $promociones = Promociones::all();
        $fechaActual = date("Y-m-d");
        
        $lisevento = Eventos::where('limite_inscripcion','>',$fechaActual)->orderBy('limite_inscripcion', 'asc')->get();
        //return  $lisevento ;

        // nuevo

        $servicios = Categorias::where("tipo", "=", 1)->get();

        $sedes = Sede::get();

        $empresa = Empresa::first();

        $salas = DB::table('salas')->get();



        return view(

            'web.inicio',

            array(

                'sliderIni' => $sliderIni,

                'comentarios' => $comentarios,

                'conociendonos' => $conociendonos,

                'promociones' => $promociones,

                'servicios' => $servicios,

                'sedes' => $sedes,

                'empresa' => $empresa,

                'salas' => $salas,

                'lisevento' => $lisevento,

            )

        );

    }

    public function servicios($id)
    {

        $portada = DB::select("SELECT * FROM slider_portadas WHERE  portada_id=1");

        // $categorias = Categorias::where("tipo", "=", 1)->get();

        $categorias = Categorias::where('id_categoria', $id)->get();

        foreach ($categorias as $key => $value) {

            $categorias[$key]['subservicios'] = ProductoServicio::where('id_categoria', $value->id_categoria)->get();

            $estrellas = [

                $value->estrella5,

                $value->estrella4,

                $value->estrella3,

                $value->estrella2,

                $value->estrella1

            ];

            $cantidad = max($estrellas);

            $posicion = array_search($cantidad, $estrellas);

            switch ($posicion) {
                case 0:
                    $categorias[$key]['calificacion'] = 'rating_5';
                    break;
                case 1:
                    $categorias[$key]['calificacion'] = 'rating_4';
                    break;
                case 2:
                    $categorias[$key]['calificacion'] = 'rating_3';
                    break;
                case 3:
                    $categorias[$key]['calificacion'] = 'rating_2';
                    break;
                case 4:
                    $categorias[$key]['calificacion'] = 'rating_1';
                    break;
                default:
                    $categorias[$key]['calificacion'] = '';
                    break;

            }

        }

        // $productoservicio = ProductoServicio::all();

        $sliderIni = SliderInicio::all();

        return view(

            'web.servicios',

            array(

                // 'productoservicio' => $productoservicio,

                'servicios' => $categorias,

                'portada' => $portada,

                'sliderIni' => $sliderIni,



            )

        );

    }
    public function gifcard()
    {

        $portada = DB::select("SELECT * FROM slider_portadas WHERE  portada_id=2");

        $categoriasg = Categorias::where("tipo", "=", 3)->get();

        $productoserviciog = ProductoServicio::all();

        return view(

            'web.gifcard',

            array(

                'productoservicio' => $productoserviciog,

                'categorias' => $categoriasg,

                'portada' => $portada,



            )

        );

    }
    public function boutique()
    {

        $portada = DB::select("SELECT * FROM slider_portadas WHERE  portada_id=3");

        $categoriasg = Categorias::where("tipo", "=", 2)->get();

        $productoserviciog = ProductoServicio::select(
            'tipo_categoria.tipo_descripcion',
            'categoria.nombre_categoria', 
            'productoservicio.*')
        ->join('categoria','categoria.id_categoria','=','productoservicio.id_categoria')
        ->join('tipo_categoria','tipo_categoria.tipo','=','categoria.tipo')
        ->where('categoria.tipo','=',2)
        ->get();



        return view(

            'web.boutique',

            array(

                'productoservicio' => $productoserviciog,

                'categorias' => $categoriasg,

                'portada' => $portada,



            )

        );

    }
    public function contacto()
    {



        $portada = DB::select("SELECT * FROM slider_portadas WHERE  portada_id=4");

        $sedes = Sede::all();

        return view('web.contacto', array('portada' => $portada, 'sedes' => $sedes));

    }
    public function inscripcion($id){

        $evento = Eventos::find($id);
        $sedes = Sede::get();
        return view('web.inscripcion',array('evento'=>$evento,'sedes'=>$sedes));
    }

    public function LibroReclamacion(){
        
        return view('web.libroReclamacion');
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

