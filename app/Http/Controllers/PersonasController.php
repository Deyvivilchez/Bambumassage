<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::select(
            '*',
            DB::raw(
                "CONCAT(nombres,' ',
                apellido_paterno,' ',
                apellido_materno,' - ',
                num_documento)
                AS nombre_completo"
            )
        )
            ->join('tipo_documentos', 'tipo_documentos.id_tipo_documento', '=', 'personas.id_tipo_documento')
            ->where('id_persona', '>', 1)
            ->get();
        echo json_encode(['listaPersonas' => $personas]);
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
        try {
            $input = $request->all();
            $persona = new Persona;
            $persona->id_tipo_documento = $input['id_tipo_documento'];
            $persona->num_documento = $input['num_documento'];
            $persona->nombres = $input['nombres'];
            $persona->apellido_paterno = $input['apellido_paterno'];
            $persona->apellido_materno = $input['apellido_materno'];
            $persona->fecha_nacimiento = $input['fecha_nacimiento'];
            $persona->direccion = $input['direccion'];
            $persona->sexo = $input['sexo'];
            $persona->celular = $input['celular'];
            $persona->correo = $input['correo'];
            $persona->id_distrito = $input['id_distrito'];
            $persona->estado_civil = $input['estado_civil'];

            $destinoimagen = 'imagenes/fotos/Persona/';

            if ($request->hasFile('foto')) {

            $file = $request->file("foto");

            // $nombrearchivo  = $file->getClientOriginalName();
            $nombre_foto = Str::slug($input['nombres'] . "-" . $input['num_documento'] . "-" . date("|Y-m-d H:i:s")) . "." . $file->guessExtension();
            //estamos renombrado el archivo

            $file->move(public_path($destinoimagen), $nombre_foto);
            $persona->foto = $nombre_foto;

            $persona->save();
            return response()->json(["verificado" => true]);
            } else {
                $nombre_foto = 'person.jpg';
                $persona->foto = $nombre_foto;
                $persona->save();
                return response()->json(["verificado" => true]);
                // return response()->json(["verificado" => false]);
             }
        } catch (\Throwable $e) {
            return response()->json(["verificado" => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $personas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
            $input = $request->all();
            $persona = Persona::find($id);
            $persona->id_tipo_documento = $input['id_tipo_documento'];
            $persona->num_documento = $input['num_documento'];
            $persona->nombres = $input['nombres'];
            $persona->apellido_paterno = $input['apellido_paterno'];
            $persona->apellido_materno = $input['apellido_materno'];
            $persona->fecha_nacimiento = $input['fecha_nacimiento'];
            $persona->direccion = $input['direccion'];
            $persona->sexo = $input['sexo'];
            $persona->celular = $input['celular'];
            $persona->correo = $input['correo'];
            $persona->id_distrito = $input['id_distrito'];
            $persona->estado_civil = $input['estado_civil'];

            $destinoimagen = 'imagenes/fotos/Persona/';

            if ($request->hasFile('foto')) {

                $file = $request->file("foto");

                //  $nombrearchivo  = $file->getClientOriginalName();
                $nombre_foto = Str::slug($input['nombres'] . "-" . $input['num_documento'] . "-" . date("|Y-m-d H:i:s")) . "." . $file->guessExtension(); //estamos renombrado el archivo
                $file->move(public_path($destinoimagen), $nombre_foto);
                $persona->foto = $nombre_foto;
            }
            $persona->save();
            echo json_encode(true);
        // } catch (TestException $e) {
        //     echo "Caught TestException ('{$e->getMessage()}')\n{$e}\n";
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy($persona)
    {
        $persona = Persona::find($persona);
        $persona->delete();

        return response()->json(true);
    }

    // MÉTODOS ADICIONALES

    public function buscarPersona(Request $request)
    {

        $input = $request->all();
        $dato = $input['data'];


        if (is_numeric($dato)) {

            //busqueda por Dni  TO_CHAR hace el cambio del campo entero a varchar  solo para la busqueda

            $sql_resultado = DB::select("SELECT * FROM personas WHERE TO_CHAR(num_documento, '9999999999') LIKE '%$dato%'; ");
            // echo json_encode($sql_resultado);

        } else {
            $dato = strtoupper($dato);
            $sql_resultado = DB::select("SELECT * FROM personas WHERE nombres LIKE '%$dato%' or apellido_materno LIKE '%$dato%'");
            //   echo json_encode($sql_resultado);
        }
        echo json_encode($sql_resultado);
    }

    public function consultaReniec(Request $request)
    {

        // print($request->dni);
        // $input = $request->all();
        // $dni = $input['doc'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.apis.net.pe/v1/dni?numero=' . $request->dni);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
       // return response()->json($data);
    }

    // public function rolesDisponibles($id_persona)
    // {
    //     $roles = Rol::where('id_rol', '>', 1)
    //     ->whereDoesntHave('usuarios', function (Builder $query) use ($id_persona) {
    //         $query->where('id_persona', $id_persona);
    //     })->get();

    //     return response()->json(['roles' => $roles]);
    // }
}
