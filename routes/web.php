<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'welcome'])->name('welcome');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    //Route::get('/leads', [LeadController::class, 'index']) -> name ('leads.index');
//Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
//Route::post('/leads', [LeadController::class, 'store']) -> name('leads.store');
//Route::get('/leads/{lead}', [LeadController::class, 'show']) -> name('leads.show');
//Route::get('/leads/{lead}/edit', [LeadController::class, 'edit']) -> name('leads.edit');
//Route::put('/leads/{lead}', [LeadController::class, 'update']) -> name('leads.update');
//Route::delete('/leads/{lead}', [LeadController::class, 'destroy']) -> name('leads.destroy');


Route::resource('leads', LeadController::class);

//Route::get('/leads', function () {
//    return view('leads');
// })->name('leads.index');

Route::resource('registros', RegistroController::class)->except(['destroy', 'edit', 'update']);

Route::get('/registros/{leadId}/{registroId}/edit', [RegistroController::class, 'edit'])->name('registros.edit');

Route::delete('/leads/{leadId}/registros/{registroId}', [RegistroController::class, 'destroy'])->name('registros.destroy');

Route::put('/leads/{leadId}/registros/{registroId}', [RegistroController::class, 'update'])->name('registros.update');

Route::get('/registros/{leadId}/{registro}', [RegistroController::class, 'show'])->name('registros.show');

Route::get('/registros/{leadId}',  [RegistroController::class, 'index'])->name('registros.index');
Route::get('/registros/{leadId}/{registroId}/edit', [RegistroController::class, 'edit'])->name('registros.edit');


});