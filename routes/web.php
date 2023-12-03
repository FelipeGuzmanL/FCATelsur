<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtiquetasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::resource('sitios', App\Http\Controllers\SitiosController::class);
	Route::resource('equiposmsan', App\Http\Controllers\EquiposMSANController::class);
	Route::resource('equiposmsan.slots', App\Http\Controllers\SlotController::class);
	Route::resource('equiposmsan.slots.olt', App\Http\Controllers\SlotMSANController::class);
	Route::resource('cable', App\Http\Controllers\CableController::class);
	Route::get('slots/{olt}/olt', [App\Http\Controllers\SlotMSANController::class, 'generarolts'])->name('generarolts.olt');
	Route::resource('equiposmsan.slots.olt.cables', App\Http\Controllers\CableUnicoController::class);
	Route::resource('cable.detallecable', App\Http\Controllers\DetalleCableController::class);
    Route::get('sitios/{sitios}/cables', [App\Http\Controllers\SitiosController::class, 'index_cable'])->name('sitios.index_cable');
    Route::get('sitios/{sitios}/equiposmsan', [App\Http\Controllers\SitiosController::class, 'index_equipo'])->name('sitios.index_equipo');
	Route::resource('mantenciones', \App\Http\Controllers\MantencionesController::class);
	//Route::get('mantencionesmsan',[App\Http\Controllers\MantencionesController::class, 'index_msan'])->name('mantenciones.index_msan');
	Route::get('mantencionesmsan', ['as' => 'index_msan.index', 'uses' => 'App\Http\Controllers\MantencionesController@index_msan']);
	Route::get('mantencionesmsan/{equipo}/msan', [App\Http\Controllers\MantencionesController::class, 'index_msan_mantencion'])->name('mantenciones.index_msan_mantencion');
	Route::resource('equiposmsan.mantencionesmsan', \App\Http\Controllers\MantencionesMSANController::class);
	Route::resource('equiposmsan.slots.olt.alertas', App\Http\Controllers\AlertaController::class);
	Route::get('cable/{detallecables}/alertas', [App\Http\Controllers\AlertaController::class, 'index_cable'])->name('cables.index_cable');
	Route::post('cable/{detalles}/alertas', [App\Http\Controllers\AlertaController::class, 'store_cable'])->name('cables.store_cable');
	Route::get('cable/{detalles}/alertasedit', [App\Http\Controllers\AlertaController::class, 'edit_cable'])->name('cables.edit_cable');
	Route::put('cable/{detalles}/alertasedit', [App\Http\Controllers\AlertaController::class, 'update_cable'])->name('cables.update_cable');
	Route::delete('cable/{detalles}/alertasedit', [App\Http\Controllers\AlertaController::class, 'destroy_cable'])->name('cables.destroy_cable');
	Route::get('cable/{detalles}/show', [App\Http\Controllers\AlertaController::class, 'show_cable'])->name('cables.show_cable');
    Route::get('alertas', [App\Http\Controllers\AlertaController::class, 'index_todaslasalertas'])->name('alertas.index_todas');
    Route::get('todaslasmantencionesmsan', [App\Http\Controllers\MantencionesController::class, 'index_todaslasmantenciones'])->name('mantencionesmsan.index_todaslasmantenciones');
	Route::resource('cablestroncales', App\Http\Controllers\CablesTroncalesController::class);
    Route::resource('cable.mufas', App\Http\Controllers\MufasController::class);
    Route::get('cable/{alerta}/alertasmufasedit', [App\Http\Controllers\AlertaController::class, 'edit_mufas'])->name('mufas.edit_mufa');
    Route::put('cable/{alerta}/alertasmufasedit', [App\Http\Controllers\AlertaController::class, 'update_mufas'])->name('mufas.update_mufa');
    Route::get('cable/{mufa}/alertasmufascreate', [App\Http\Controllers\AlertaController::class, 'create_mufas'])->name('mufas.create_mufa');
    Route::get('cable/{alerta}/alertasmufas', [App\Http\Controllers\AlertaController::class, 'index_mufas'])->name('mufas.index_mufa');
    Route::post('cable/{mufa}/alertasmufas', [App\Http\Controllers\AlertaController::class, 'store_mufas'])->name('mufas.store_mufa');
    Route::delete('cable/{mufa}/alertasmufas', [App\Http\Controllers\AlertaController::class, 'destroy_mufas'])->name('mufas.destroy_mufa');
	Route::resource('etiquetas',App\Http\Controllers\EtiquetasController::class);
    Route::get('etiquetas/{etiqueta}/show', [App\Http\Controllers\EtiquetasController::class, 'show_filamento'])->name('etiquetas.show_filamento');
    //Route::get('etiquetas/export', [EtiquetasController::class, 'export'])->name('etiquetas.export');
    //Route::get('/etiquetas/export', 'EtiquetasController@export')->name('etiquetas.export');
    //Route::get('etiquetas/export', 'App\Http\Controllers\EtiquetasController@export')->name('etiquetas.export');
    Route::get('/exportar-etiquetas', [EtiquetasController::class, 'export'])->name('etiquetas.export');
    Route::get('crearetiqueta/{equipo}/{slot}/{olt}', [App\Http\Controllers\SlotMSANController::class, 'crear_etiqueta'])->name('olt.crearetiqueta');
    Route::get('actualizaretiqueta/{equipo}/{slot}/{olt}/{etiquetas}', [App\Http\Controllers\SlotMSANController::class, 'actualizar_etiqueta'])->name('olt.actualizaretiqueta');
    Route::post('/imprimir/{etiqueta}', [App\Http\Controllers\SlotMSANController::class, 'imprimir'])->name('imprimir');
    Route::get('cable/detallecable/getfilamentosbycable', 'App\Http\Controllers\DetalleCableController@getFilamentosByCable')->name('cable.detallecable.getfilamentosbycable');
    Route::get('/consulta-cable/{cableId}', 'DetalleCableController@consultaCable');
    Route::get('/etiquetas/ejecutar-script', 'EtiquetasController@ejecutarScript')->name('etiquetas.ejecutar-script');
    Route::get('/alertasolt', [App\Http\Controllers\AlertaController::class, 'index_olt'])->name('alertas.index_olt');
    Route::get('capacidadcables', [App\Http\Controllers\AlertaController::class, 'index_capacidadcables'])->name('alertas.index_capacidadcables');
    #Route::post('/api/cable', [App\Http\Controllers\CableController::class, 'procesarDatosDesdePython']);
    #Route::match(['get', 'post'],'/api/cable', [App\Http\Controllers\CableController::class, 'procesarDatosDesdePython']);
    #Route::get('/api/cable/otra-funcion', [App\Http\Controllers\CableController::class, 'otraFuncion'])->name('otraFuncion');
    #Route::post('/api/cable', 'App\Http\Controllers\CableController@procesarDatosDesdePython');
    Route::get('/api/cable/otra-funcion', [App\Http\Controllers\CableController::class, 'otraFuncion'])->name('otraFuncion');
    Route::delete('destroyall', 'App\Http\Controllers\EtiquetasController@destroy_all')->name('destroyall');
    Route::post('etiquetascreateall', 'App\Http\Controllers\EtiquetasController@create_all')->name('createall');
    Route::get('/webcam', [App\Http\Controllers\WebcamController::class, 'index'])->name('webcam');
    Route::post('/capture',[App\Http\Controllers\WebcamController::class, 'capture']);
<<<<<<< HEAD
    Route::match(['get','post'],'/flask',[App\Http\Controllers\WebcamController::class, 'desdeflask']);
    Route::post('/procesar_imagen', [App\Http\Controllers\WebcamController::class, 'procesarImagen']);
    Route::match(['get','post'],'/procesar-desde-flask', [App\Http\Controllers\EtiquetasController::class, 'procesarDesdeFlask']);
    Route::get('/verjsondesdeflask', [App\Http\Controllers\EtiquetasController::class, 'verjsondesdeflask']);
    Route::match(['get','post'],'/procesar-imagen-laravel', [App\Http\Controllers\WebcamController::class, 'procesarImagenLaravel']);
    Route::get('/cors-test', function() {
        dd("This won't work");
     });



=======
    Route::match(['get','post'],'/procesar_imagen', [App\Http\Controllers\WebcamController::class, 'procesarImagen']);
    Route::match(['get','post'],'/flask',[App\Http\Controllers\WebcamController::class, 'desdeflask']);
    Route::get('/verjson',[App\Http\Controllers\WebcamController::class, 'verJson'])->name('verjson');
>>>>>>> c4c2c56cf27cd4cd6fa9d3eefb8f0278b7fe4fd9
});

Route::group(['middleware' => ['web']], function () {
    Route::match(['post','get'],'/api/cable', 'App\Http\Controllers\CableController@procesarDatosDesdePython')->name('apiCable');
    //Route::match(['get','post'],'/procesar-desde-flask', 'App\Http\Controllers\EtiquetasController@procesarDesdeFlask');
});

<<<<<<< HEAD
/*Route::middleware(['cors'])->group(function () {
    Route::post('/procesar-desde-flask', [App\Http\Controllers\EtiquetasController::class, 'procesarDesdeFlask']);
});*/
/*Route::group(['middleware' => ['cors']], function () {
    Route::post('/guardar-imagen', [App\Http\Controllers\WebcamController::class, 'guardarImagen']);
});*/
=======
/*Route::middleware('cors')->group(function () {
    //
});*/


>>>>>>> c4c2c56cf27cd4cd6fa9d3eefb8f0278b7fe4fd9


