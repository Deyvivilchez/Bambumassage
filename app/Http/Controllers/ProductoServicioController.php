<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoServicio;
use Illuminate\Support\Facades\DB;
use App\Models\Portadas;
use Illuminate\Support\Str;

class ProductoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function ProductoServicioController(Request $request){

        $id_tipo = $request['id'];
        $color = DB::select('SELECT c.color FROM categoria as c WHERE id_categoria=' . $id_tipo .'');
        $Productos = DB::select('SELECT ps.id_productoservicio, ps.nombre_productoservicio,
        c.id_categoria, c.nombre_categoria, ps.descripcion, ps.imagen,ps.precio
        FROM productoservicio as ps  inner join categoria  as c on ps.id_categoria=c.id_categoria
        where ps.estado=1 and c.id_categoria=' . $id_tipo .'');
        echo json_encode(['lisproductos' => $Productos,'color'=> $color[0] ]);

    }
     public function CrearProducto(Request $request){

        $input = $request->all();
      //  print_r()
        $producto = new ProductoServicio;
        $producto->id_categoria = $input['categoria'];
        $producto->nombre_productoservicio = $input['nombre'];
        $producto->descripcion = $input['descripcion'];
        $producto->precio = $input['precio'];
        $producto->estado = 1;
        $destinoimagen='web/images/img_productos/';
        if ($request->hasFile('imagen')){
            $file= $request->file("imagen");
            $nombrearchivo  =  Str::slug('ProdServicio'. "-" . date("Y-m-d H:i:s")) . "." . $file->guessExtension();
            $file->move(public_path($destinoimagen),$nombrearchivo);
            $producto->imagen = $nombrearchivo;
            $producto->save();
            return response()->json([ 'create_respuesta' => true]);
        }else{
            return response()->json([ 'create_respuesta' => false]);
        }
     }
     public function actualizarProducto(Request $request){

        $input = $request->all();
        $id_producto = $input['idprod'];
        $producto =ProductoServicio::find($id_producto);
        $producto->id_categoria = $input['categoria'];
        $producto->nombre_productoservicio = $input['nombre'];
        $producto->descripcion = $input['descripcion'];
        $producto->precio = $input['precio'];
        $producto->estado = 1;
        $producto->update();
        return response()->json([ 'update_respuesta' => true]);

    }
    public function actualizarProductoImagen(Request $request){

        $input = $request->all();
        $id_producto = $input['idproducto'];
        $producto =ProductoServicio::find($id_producto);
        $destinoimagen='web/images/img_productos/';

        if ($request->hasFile('imagen')){
            $file= $request->file("imagen");
            $nombrearchivo  =  Str::slug('ProdServicio'. "-" .
             date("Y-m-d H:i:s")) . "." . $file->guessExtension();
            $file->move(public_path($destinoimagen),$nombrearchivo);
            $producto->imagen = $nombrearchivo;
            $producto->update();
            return response()->json([ 'update_respuesta' => true]);
        }else{
            return response()->json([ 'update_respuesta' => false]);
        }

    }
                    //actualizarPortada
    public function actualizarP(Request $request)
    {
        //Comentarios $comentarios
        $input = $request->all();
       // print_r($input);
        $cod = $input['id_portada'];
        $portada =Portadas::find($cod);

             echo json_encode($portada);
        $destinoimagen='web/images/portadas/';
        if ($request->hasFile('imagen_portada')){
            $file= $request->file("imagen_portada");
            $nombrearchivo  =  Str::slug($file->getClientOriginalName() . "-" . date("Y-m-d H:i:s")) . "." . $file->guessExtension();
            $file->move(public_path($destinoimagen),$nombrearchivo);
            $portada->imagen = $nombrearchivo;
            $portada->update();
            echo json_encode('Actualizacion Exitosa');
        }else{
            echo json_encode('Error en el Registro ');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //   $productoServicio = ProductoServicio::all();
        // return response()->json($productoServicio);
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
        $descripcion = $input['nombreProducto'];
        //echo json_encode(['input' => $input]);
        echo ($descripcion);

        // $productoServicio = ProductoServicio::create($request->post());
        // return response()->json([
        //     'producto' => $productoServicio
        // ]);
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

    public function update()
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $productoServicio->delete();
        // return response()->json([
        //     'mensaje' => 'Producto Eliminado'
        // ]);


        $productoServicio = ProductoServicio::find($id);
        $productoServicio->delete();
        echo json_encode(['mensaje' => '¡Registro eliminado correctamente!']);
    }
}
