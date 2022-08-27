<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/pergunta', \App\Http\Livewire\Pergunta\Show::class)->name('perguntaShow');
Route::get('/pergunta/{action}/{pergunta?}', \App\Http\Livewire\Pergunta\Form::class)->name('perguntaForm');

Route::get('/base-juridica', \App\Http\Livewire\BaseJuridica\Show::class)->name('baseJuridicaShow');
Route::get('/base-juridica/{action}/{baseJuridica?}', \App\Http\Livewire\BaseJuridica\Form::class)->name('baseJuridicaForm');