<?php
namespace App\Http\Controllers;
use App\Models\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class AdmComentarios extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $comentarios = Comentarios::all();

        echo json_encode(['comentarios' => $comentarios]);
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

     *

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
        $cod = $input['id_comentario'];
        $comentarios = Comentarios::find($cod);
        $comentarios->comentario = $input['comentario'];
        $comentarios->autor = $input['autor'];
        $destinoimagen = 'web/images/img_comentarios/'; 
        if ($input['imagen'] == 0) {
            $comentarios->update();
            return response()->json(['valor' => true]);
        } else {
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombrearchivo  =  Str::slug($file->getClientOriginalName() . "-" .
                 date("F j, Y, g , i , a")) . 
                 "." . $file->guessExtension();
                $file->move(public_path($destinoimagen), $nombrearchivo);
                $comentarios->imagen = $nombrearchivo;
                $comentarios->update();
                return response()->json(['valor' => true]);
            } else {

                return response()->json(['valor' => false]);
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
