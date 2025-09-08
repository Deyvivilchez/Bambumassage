<?php

namespace App\Http\Controllers;

use App\Models\DetalleEventos;
use App\Models\Eventos;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response Inscritos
     */
    public function index()
    {
        $listEventos = Eventos::select('*')
        ->with(['Inscritos'=> function($inscritos){
                     $inscritos->join('personas', 'personas.id_persona', '=', 'detallevento.id_persona')
                    ->select('detallevento.id_detalleevento','detallevento.id_evento', 'personas.*');
        }])
        ->paginate(8);
        return $listEventos;
    }
    public function EvntosEnModal(){

    //     $evento = Eventos::get();
    //    // return $evento;
    //    return response()->json($evento);

       $fechaActual = date("Y-m-d");
        $lisevento = Eventos::where('limite_inscripcion','>',$fechaActual)->orderBy('limite_inscripcion', 'asc')->get();
        return  $lisevento ;
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
        // $input = $request->all();
        // print_r( $input);

        $destinoEvento = 'web/images/eventos/';
        $evento = new Eventos();
        if($request->hasFile('banner')){

            $imagen = $request->banner;
            $nombreImagen = Str::slug('evento-'. $request->nombre .date("|Y-m-d H:i:s")).".".$imagen->guessExtension();
            $imagen->move(public_path($destinoEvento),$nombreImagen);
            $evento->titulo_evento=$request->nombre;
            $evento->flayer=$nombreImagen;
            $evento->fecha_evento = $request->fechaEvento;
            $evento->limite_inscripcion =$request->fechaLimite;
            $evento->save();
            return response()->json(["verificado" => true,"evento" =>$evento]);
            
        }else{
            return response()->json(["verificado" => false]);
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
    public function update(Request $request)
    {
     
        $destinoEvento = 'web/images/eventos/';
        $evento =  Eventos::find( $request->id_evento);

        if($request->hasFile('banner')){
            $imagen = $request->banner;
            $nombreImagen = Str::slug('evento-'. $request->nombre .date("|Y-m-d H:i:s")).".".$imagen->guessExtension();
            $imagen->move(public_path($destinoEvento),$nombreImagen);
            $evento->titulo_evento=$request->nombre;
            $evento->flayer=$nombreImagen;
            $evento->fecha_evento = $request->fechaEvento;
            $evento->limite_inscripcion =$request->fechaLimite;
            $evento->save();
            return response()->json(["verificado" => true,"evento" =>$evento]);
            
        }else{
            $evento->titulo_evento=$request->nombre;
            $evento->flayer=$request->banner;
            $evento->fecha_evento = $request->fechaEvento;
            $evento->limite_inscripcion =$request->fechaLimite;
            $evento->update();
            return response()->json(["verificado" => true,"evento" =>$evento]);
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
        $evento = Eventos::find($id);
        $evento->delete();
        return response()->json(["verificado" => true]);
    }
    public function inscripcion(Request $request){

        $fechaActual = date("Y-m-d");
        $sqlPersona = Persona::where('num_documento',$request->dni)->get();
        if(count( $sqlPersona) > 0 ){

            //echo  $sqlPersona[0];

            $inscripcion = new DetalleEventos;
            $inscripcion->id_persona=$sqlPersona[0]->id_persona;
            $inscripcion->id_evento= $request->id_evento;
            $inscripcion->id_sede= $request->sede;
            $inscripcion->fecha_inscripcion =$fechaActual;
            $inscripcion->save(); 
            return response()->json(["verificado" => true]);
            
        }else{

            $persona = new Persona();
            $persona->num_documento=$request->dni;
            $persona->nombres=$request->nombres;
            $persona->apellido_paterno=$request->apellidop;
            $persona->apellido_materno=$request->apellidom;
            $persona->celular=$request->telefono;
            $persona->correo=$request->correo;
            $persona->save();

            $inscripcion = new DetalleEventos;
            $inscripcion->id_persona =$persona->id_persona;
            $inscripcion->id_evento = $request->id_evento;
            $inscripcion->fecha_inscripcion =$fechaActual;
            $inscripcion->id_sede= $request->sede;
            $inscripcion->save();
            return response()->json(["verificado" => true]);
            

        }
        
        
    }
}
