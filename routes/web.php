<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
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
    return view('auth.login');
});

/*Route::get('/empleado', function () {
    return view('empleado.index');
});
 //hacer la ruta de empleado con laravel 9
//Route::get('empleado', EmpleadoController::class, 'index');

Route::get('empleado/create', [EmpleadoController::class,'create']);*/
 //ya no necesito las de arriba xqe esta nueva me obtine todas las rutas para empleado
Route::resource('empleado', EmpleadoController::class)->middleware('auth');


Auth::routes(['register'=>true,'reset'=>true]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
//cuando haga login me redirija a la pagina de empleado
//y si no esta logeado me redirija a la pagina de login
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});