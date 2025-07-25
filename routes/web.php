<?php

use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttentationController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CounterPrestationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Ruta para la página de desarrolladores
Route::get('/developers', function () {
    return view('developers');
})->name('developers');

// Ruta para la página de desarrolladores
Route::get('/tecnologias', function () {
    return view('tecnologias');
})->name('tecnologias');



Auth::routes(['middleware' => 'role.redirect']);

// Rutas protegidas por rol de Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {

        //Ruta del dashboard de Administrador
        Route::get('/dashboard', [UserController::class, 'admin_dashboard'])->name('admin.dashboard');

        //Ruta para el Registro de más Adminitradores
        Route::get('/Registro-Administrador', [UserController::class, 'register_admin'])->name('admin.register_admin');


        //Rutas del Asistencia
        Route::get('/Asistencia', [AttendanceController::class, 'listado'])->name('admin.asistencia.index');
        Route::get('/Asistencia/create', [AttendanceController::class, 'create'])->name('admin.asistencia.create');
        Route::post('/Asistencia/store', [AttendanceController::class, 'store'])->name('admin.asistencia.store');
        Route::get('/Asistencia/edit/{id}', [AttendanceController::class, 'edit'])->name('admin.asistencia.edit');
        Route::put('/Asistencia/update/{id}', [AttendanceController::class, 'update'])->name('admin.asistencia.update');
        Route::delete('/Asistencia/destroy/{id}', [AttendanceController::class, 'destroy'])->name('admin.asistencia.destroy');


        //Rutas de   llamado de Atención
        Route::get('/Llamado-Atención', [AttentationController::class, 'listado'])->name('admin.atencion.index');
        Route::get('/Llamado-Atención/create', [AttentationController::class, 'create'])->name('admin.atencion.create');
        Route::post('/Llamado-Atención/store', [AttentationController::class, 'store'])->name('admin.atencion.store');
        Route::get('/Llamado-Atención/edit/{id}', [AttentationController::class, 'edit'])->name('admin.atencion.edit');
        Route::put('/Llamado-Atención/update/{id}', [AttentationController::class, 'update'])->name('admin.atencion.update');
        Route::delete('/Llamado-Atención/destroy/{id}', [AttentationController::class, 'destroy'])->name('admin.atencion.destroy');

        //Rutas de la Horas de Contra-Prestación
        Route::get('/Contra-Prestación', [CounterPrestationController::class, 'listado'])->name('admin.contra_prestacion.index');
        Route::get('/Contra-Prestación/create', [CounterPrestationController::class, 'create'])->name('admin.contra_prestacion.create');
        Route::post('/Contra-Prestación/store', [CounterPrestationController::class, 'store'])->name('admin.contra_prestacion.store');
        Route::get('/Contra-Prestación/edit/{id}', [CounterPrestationController::class, 'edit'])->name('admin.contra_prestacion.edit');
        Route::put('/Contra-Prestación/update/{id}', [CounterPrestationController::class, 'update'])->name('admin.contra_prestacion.update');
        Route::delete('/Contra-Prestación/destroy/{id}', [CounterPrestationController::class, 'destroy'])->name('admin.contra_prestacion.destroy');

        //Rutas de Programas de Formación
        Route::get('/Programas-Formación', [ProgramController::class, 'listado'])->name('admin.programa.index');
        Route::get('/Programas-Formación/create', [ProgramController::class, 'create'])->name('admin.programa.create');
        Route::post('/Programas-Formación/store', [ProgramController::class, 'store'])->name('admin.programa.store');
        Route::get('/Programas-Formación/edit/{id}', [ProgramController::class, 'edit'])->name('admin.programa.edit');
        Route::put('/Programas-Formación/update/{id}', [ProgramController::class, 'update'])->name('admin.programa.update');
        Route::delete('/Programas-Formación/destroy/{id}', [ProgramController::class, 'destroy'])->name('admin.programa.destroy');


        //Rutas de Gestión de Aprendices
        Route::get('/Aprendices', [ApprenticeController::class, 'listado'])->name('admin.aprendices.index');
        Route::get('/Aprendices/create', [ApprenticeController::class, 'create'])->name('admin.aprendices.create');
        Route::post('/Aprendices/store', [ApprenticeController::class, 'store'])->name('admin.aprendices.store');
        Route::get('/Aprendices/edit/{id}', [ApprenticeController::class, 'edit'])->name('admin.aprendices.edit');
        Route::put('/Aprendices/update/{id}', [ApprenticeController::class, 'update'])->name('admin.aprendices.update');
        Route::delete('/Aprendices/destroy/{id}', [ApprenticeController::class, 'destroy'])->name('admin.aprendices.destroy');

        //Ruta para la aprobacion o el rechazo del Permiso de Salida
        Route::get('/Salida-internado', [RequestController::class, 'request_index_admin'])->name('admin.aprendices.request.index_admin');
        Route::post('/Salida-internado/{id}/rechazar', [RequestController::class, 'request_reject'])->name('admin.aprendices.request.rechazar');
        Route::post('/Salida-internado/{id}/aceptar', [RequestController::class, 'request_accept'])->name('admin.aprendices.request.aceptar');

    });
});


 // Rutas protegidas por rol de Aprendiz
Route::middleware(['auth', 'role:aprendiz'])->group(function () {
    Route::prefix('/aprendiz')->group(function () {

        //Ruta del dashboard de Aprendiz
        Route::get('/dashboard', [UserController::class, 'aprendiz_dashboard'])->name('aprendiz.dashboard');

        //Rutas del listado de llamado de Atención
        Route::get('/Llamado-Atención', [AttentationController::class, 'aprendiz_index'])->name('aprendiz.atencion.index');

        //Rutas del listado de la Asistencia
        Route::get('/Asistencia', [AttendanceController::class, 'aprendiz_index'])->name('aprendiz.asistencia.index');

        //Rutas del listado de las Horas de Contra-Prestación
        Route::get('/Contra-Prestación', [CounterPrestationController::class, 'aprendiz_index'])->name('aprendiz.contra_prestacion.index');

        //Rutas de los Permisos de Salida
        Route::get('/Salida-internado', [RequestController::class, 'request_index'])->name('aprendiz.request.index');
        Route::get('/Salida-internado/create', [RequestController::class, 'request_create'])->name('aprendiz.request.create');
        Route::post('/Salida-internado/store', [RequestController::class, 'request_store'])->name('aprendiz.request.store');
        Route::get('/Salida-internado/edit/{id}', [RequestController::class, 'request_edit'])->name('aprendiz.request.edit');
        Route::put('/Salida-internado/update/{id}', [RequestController::class, 'request_update'])->name('aprendiz.request.update');
        Route::get('/Salida-internado/destroy/{id}', [RequestController::class, 'request_destroy'])->name('aprendiz.request.delete');
    });
});


//Ruta por defecto para el Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
