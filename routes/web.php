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

Route::middleware('check.lead.cookie')
    ->group( function()
    {
        Route::get('/', \App\Http\Livewire\WebSite\Home::class)->name('homeWebSite');
        
        Route::get('/pergunta', \App\Http\Livewire\WebSite\Pergunta::class)->name('perguntaWebSite');
        
        Route::get('/resultado', \App\Http\Livewire\WebSite\Resultado::class)->name('resultadoWebSite');

        Route::get('/informações-necessarias', \App\Http\Livewire\WebSite\CapturaDadosLead::class)->name('capturaDadosLeadWebSite');
    }
);