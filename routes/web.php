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

Route::get('/', \App\Http\Livewire\WebSite\Home::class)->name('homeWebSite');

Route::get('/pergunta/{ordem}', \App\Http\Livewire\WebSite\Pergunta::class)->name('perguntaWebSite');

Route::get('/resultado/{opcao}', \App\Http\Livewire\WebSite\Resultado::class)->name('resultadoWebSite');