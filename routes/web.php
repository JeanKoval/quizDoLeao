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

Route::middleware('auth')
    ->prefix('admin')
    ->group(function (){

        Route::get('/', \App\Http\Livewire\Admin\Home::class)->name('homePageAdmin');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value, \App\Http\Livewire\Admin\Pergunta\Show::class)->name('perguntaShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value . '/{action}/{pergunta?}', \App\Http\Livewire\Admin\Pergunta\Form::class)->name('perguntaForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value, \App\Http\Livewire\Admin\BaseJuridica\Show::class)->name('baseJuridicaShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value . '/{action}/{baseJuridica?}', \App\Http\Livewire\Admin\BaseJuridica\Form::class)->name('baseJuridicaForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value, \App\Http\Livewire\Admin\Capitulo\Show::class)->name('capituloShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value . '/{action}/{capitulo?}', \App\Http\Livewire\Admin\Capitulo\Form::class)->name('capituloForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value, \App\Http\Livewire\Admin\Artigo\Show::class)->name('artigoShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value . '/{action}/{artigo?}', \App\Http\Livewire\Admin\Artigo\Form::class)->name('artigoForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value, \App\Http\Livewire\Admin\Paragrafo\Show::class)->name('paragrafoShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value . '/{action}/{paragrafo?}', \App\Http\Livewire\Admin\Paragrafo\Form::class)->name('paragrafoForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value, \App\Http\Livewire\Admin\Inciso\Show::class)->name('incisoShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value . '/{action}/{inciso?}', \App\Http\Livewire\Admin\Inciso\Form::class)->name('incisoForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value, \App\Http\Livewire\Admin\Alinea\Show::class)->name('alineaShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value . '/{action}/{alinea?}', \App\Http\Livewire\Admin\Alinea\Form::class)->name('alineaForm');

        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Lead->value, \App\Http\Livewire\Admin\Lead\Show::class)->name('leadShow');
        Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Lead->value . '/{action}/{lead?}', \App\Http\Livewire\Admin\Lead\Form::class)->name('leadForm');
        Route::get('/leads/export', [\App\Http\Controllers\LeadController::class, 'export'])->name('leadExport');
});

/**
 * Routes Web Site
 * 
 * As rotas descritas no grupo abaixo serão apresentadas para os usuários 
 * responderem o quiz, atualmente o quiz não precisa ser logado para ser respondido.
 * 
 * As rotas deste grupo obrigatoriamente o componente, no metodo render,
 * o retorno da view deve usar a função "->layout('layouts.web-site')".
 * 
 */
Route::group([], function (){

    Route::get('/', \App\Http\Livewire\WebSite\Home::class)->name('homeWebSite');

    Route::get('/pergunta/{ordem}', \App\Http\Livewire\WebSite\Pergunta::class)->name('perguntaWebSite');

    Route::get('/resultado/{opcao}', \App\Http\Livewire\WebSite\Resultado::class)->name('resultadoWebSite');

});