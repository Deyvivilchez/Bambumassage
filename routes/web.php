<?php

use App\Http\Controllers\AdmComentarios;
use App\Http\Controllers\AdmConociendonos;
use App\Http\Controllers\AdmInicioController;
use App\Http\Controllers\AdmPromocionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductoServicioController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PortadaSliderController;
use App\Http\Controllers\LibroReclamacionesController;

Route::get('/',[WebController::class,'index',]);
Route::get('servicios/{id}',[WebController::class,'servicios',]);
Route::get('gif-card',[WebController::class,'gifcard',]);
Route::get('boutique',[WebController::class,'boutique',]);
Route::get('contacto',[WebController::class,'contacto',]);
Route::get('libro-reclamacion',[WebController::class,'LibroReclamacion',]);
Route::get('inscripcion/{id}',[WebController::class,'inscripcion',]);
Route::get('/login', function () { return view('login'); });
Route::get('libro-reclamaciones/{codigo}', [LibroReclamacionesController::class, 'mostrarComprobante']);
Route::get('comprobante/{codigo}', [LibroReclamacionesController::class, 'descargarComprobante']);



Route::get('/administracion{any}',
function () { return view('app');})->where('any','.*');
Route::get('/inicio', function () { return view('app');});
Route::get('/categoria_bambu', function () { return view('app');});
Route::get('/productoservicios', function () {return view('app');});
Route::get('/portadaSlider', function () {return view('app');});
Route::get('/Eventos', function () {return view('app');});
Route::get('/FaqAdmin', function () {return view('app');});
Route::get('/Reclamaciones', function () {return view('app');});

 Route::post('listaCategorias',[CategoriasController::class,'listaCategorias']);
 Route::post('listProductos',[ProductoServicioController::class,'ProductoServicioController']);
 Route::post('CrearProducto',[ProductoServicioController::class,'CrearProducto']);
 Route::post('actualizarProducto',[ProductoServicioController::class,'actualizarProducto']);
 Route::post('actualizarProductoImagen',[ProductoServicioController::class,'actualizarProductoImagen']);
 Route::post('lista',[ProductoServicioController::class,'ProductoServicioController']);
 Route::post('actualizarImgSlider',[AdmInicioController::class,'actualizarImgSlider']);
 Route::post('actualizarComentario',[AdmComentarios::class,'update']);
 Route::post('actualizarConociendonos',[AdmConociendonos::class,'update']);
 Route::post('listaPromociones',[AdmPromocionesController::class,'listaPromociones']);
 Route::post('actualizarPromociones',[AdmPromocionesController::class,'actualizarPromociones']);
 //Route::post('actualizarImgSlider',[AdmPromocionesController::class,'ActualizarImgSlider']);
 Route::post('actualizarPortada',[ProductoServicioController::class,'actualizarP']);
 Route::post('actualizar_sliderPortada',[PortadaSliderController::class,'update']);
 Route::post('logeo',[AdmInicioController::class,'logeo']);
 Route::get('salir',[AdmInicioController::class,'salir']);


// Route::get('listaPortadas',[PortadasController::class,'index']);

