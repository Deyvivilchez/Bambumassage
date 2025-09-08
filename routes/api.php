<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\SalonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroReclamacionesController;
// use app\Http\Controllers\PortadasController;
use App\Http\Controllers\SedesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {  return $request->user(); });

Route::post('categorias/votacion', [App\Http\Controllers\CategoriasController::class, 'guardarVotacion']);

Route::resource('categoria',App\Http\Controllers\CategoriasController::class);
Route::resource('producto',App\Http\Controllers\ProductoServicioController::class);
Route::resource('admInicioController',App\Http\Controllers\AdmInicioController::class);
Route::resource('admComentarios',App\Http\Controllers\AdmComentarios::class);
Route::resource('portadas',App\Http\Controllers\PortadaSliderController::class);
Route::resource('admConociendonos',App\Http\Controllers\AdmConociendonos::class);
Route::resource('admPromociones',App\Http\Controllers\AdmPromocionesController::class);
Route::get('listaSedes',[SedesController::class,'listaSedes']);
Route::apiResource('sedes', App\Http\Controllers\SedesController::class);
Route::post('eliminar_sede',[SedesController::class,'destroy']);
Route::post('editar_sede',[SedesController::class,'editar_sede']);
Route::post('actualizar_img_sede',[SedesController::class,'actualizar_img_sede']);



Route::post('list_salon_sede',[SalonController::class,'list_salon_sede']);
Route::resource('salon',SalonController::class);
Route::post('eliminar_Sala',[SalonController::class,'eliminar_Sala']);
Route::get('tipoCategorias',[CategoriasController::class,'tipoCategorias']);
Route::resource('eventos',EventosController::class);
Route::post('UpdateEventos',[EventosController::class,'update']);
Route::post('inscripcion',[EventosController::class,'inscripcion']);
Route::post('consultaReniec',[PersonasController::class,'consultaReniec']);
Route::get('EvntosEnModal',[EventosController::class,'EvntosEnModal']);
//Route::resource('portadas',App\Http\Controllers\PortadaSliderController::class);

Route::resource('reclamaciones',LibroReclamacionesController::class);




////////////////////////////////////CHATBOT FAQS////////////////////////////////////////
Route::post('faq/buscar', [FaqController::class, 'buscar']);
Route::get('faqs', [FaqController::class, 'index']);
Route::post('faqs', [FaqController::class, 'store']);
Route::put('faqs/{id}', [FaqController::class, 'update']);
Route::delete('faqs/{id}', [FaqController::class, 'destroy']);
Route::get('faq/sugerencias', [FaqController::class, 'sugerencias']);
Route::get('faq/index_cat_faqs', [FaqController::class, 'index_cat_faqs']);
Route::post('store_categoria_pregunta', [FaqController::class, 'store_categoria_pregunta']);
Route::delete('destroy_categoria_pregunta/{id}', [FaqController::class, 'destroy_categoria_pregunta']);
Route::post('update_categoria_pregunta/{id}', [FaqController::class, 'update_categoria_pregunta']);
Route::get('/subcategorias', [FaqController::class, 'index_subcategorias']);
Route::post('/subcategorias', [FaqController::class, 'store_subcategoria']);
Route::put('/subcategorias/{id}', [FaqController::class, 'update_subcategoria']);
Route::delete('/subcategorias/{id}', [FaqController::class, 'destroy_subcategoria']);
Route::post('/chatbot/evento', [FaqController::class, 'registrarEvento']);
Route::post('/chatbot/no_respuesta', [FaqController::class, 'guardarConsultaSinRespuesta']);
Route::get('/chatbot/indexConsultaSinRespuesta', [FaqController::class, 'indexConsultaSinRespuesta']);
Route::post('update_preguntaSinRespuesta/{id}', [FaqController::class, 'update_preguntaSinRespuesta']);



///comentario para subir 
