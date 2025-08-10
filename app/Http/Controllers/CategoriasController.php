<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\TipoCategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoriasController extends Controller
{
    

    public function index()
    {
       $categorias = Categorias::all();
       return response()->json(['categorias' => $categorias]);
 
    }
    public function tipoCategorias(){
        // $tipoCategorias= DB::select('SELECT * FROM tipo_categoria');
        $tipoCategorias= TipoCategorias::select('tipo_categoria.*')->with('categorias')->get();
        return response()->json(['tipoCategorias'=>$tipoCategorias]);
    }
    public function listaCategorias(Request $request)
    {
        $id_tipo = $request['id'];
        $listCategorias = DB::select('SELECT *  FROM categoria WHERE tipo=' . $id_tipo . '');
        echo json_encode(['categorias' => $listCategorias]);
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
        $input = $request->all();
        $Categorias = new Categorias;
        $Categorias->descripcion = $input['descripcion'];
        $Categorias->nombre_categoria = $input['nombre_categoria'];
        $Categorias->tipo = $input['tipo'];
        $Categorias->estado = 1;
        $Categorias->color = $request->color;

        $destinoimagen='web/images/img_servicios/';

            if ($request->hasFile('img')){

                    if($request->hasFile('imgPortada') ){
                        $file= $request->file("imgPortada");
                        $nombrePortada =  Str::slug('portadaSev'."-". date("Y-m-d H:i:s")). "." . $file->guessExtension();
                        $file->move(public_path($destinoimagen),$nombrePortada);
                    }
                    $file= $request->file("img");
                    $nombrearchivo  =  Str::slug('prodServ'."-". date("Y-m-d H:i:s")). "." . $file->guessExtension();
                    $file->move(public_path($destinoimagen),$nombrearchivo);

                    $Categorias->portadaServ = $nombrePortada;
                    $Categorias->imagen = $nombrearchivo;
                    $Categorias->save();
                    return response()->json([ 'respuesta' => true]);
            }
            
        $Categorias->save();
        return response()->json([ 'respuesta' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categorias)
    {
        return response()->json($categorias);
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
    public function update(Request $request, Categorias $categorias, $id)
    {

        $input = $request->all();
        $Cod_categorias = $input['id_categoria'];
        $Categorias = Categorias::find($Cod_categorias);
        $Categorias->descripcion = $input['descripcion'];
        $Categorias->nombre_categoria = $input['nombre_categoria'];
        $Categorias->tipo = $input['tipo'];
        $Categorias->color = $input['color'];
        $destinoimagen='web/images/img_servicios/';

        if ($request->hasFile('img')){
            $file= $request->file("img");
            $nombrearchivo  =  Str::slug('prodServ'."-". date("Y-m-d H:i:s")). "." . $file->guessExtension();
            $file->move( public_path( $destinoimagen), $nombrearchivo);
            $Categorias->imagen = $nombrearchivo;
        }
        if ($request->hasFile('imgPortada')){
            $file= $request->file("imgPortada");
            $nombrePortada =  Str::slug('portadaSev'."-". date("Y-m-d H:i:s")). "." . $file->guessExtension();
            $file->move( public_path( $destinoimagen), $nombrePortada);
            $Categorias->portadaServ = $nombrePortada;
        }

        $Categorias->update();
        return response()->json([ 'update_respuesta' => true]);
        //return response()->json([ 'respuesta' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorias = Categorias::find($id);
        $categorias->delete();
        echo json_encode(['mensaje' => '¡Registro eliminado correctamente!']);
    }

    // guardar estrellas
    public function guardarVotacion(Request $request)
    {
        $categoria = Categorias::find($request->id_categoria);
        switch ($request->calificacion) {
            case 1:
                $categoria->estrella1 += 1;
                break;
            case 2:
                $categoria->estrella2 += 1;
                break;
            case 3:
                $categoria->estrella3 += 1;
                break;
            case 4:
                $categoria->estrella4 += 1;
                break;
            default:
                $categoria->estrella5 += 1;
                break;
        }
        $categoria->save();

        return response()->json(true);
    }
}
