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

Route::middleware('auth')->group(function (){

    Route::get('/', \App\Http\Livewire\Home::class)->name('homePage');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value, \App\Http\Livewire\Pergunta\Show::class)->name('perguntaShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value . '/{action}/{pergunta?}', \App\Http\Livewire\Pergunta\Form::class)->name('perguntaForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value, \App\Http\Livewire\BaseJuridica\Show::class)->name('baseJuridicaShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value . '/{action}/{baseJuridica?}', \App\Http\Livewire\BaseJuridica\Form::class)->name('baseJuridicaForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value, \App\Http\Livewire\Capitulo\Show::class)->name('capituloShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value . '/{action}/{capitulo?}', \App\Http\Livewire\Capitulo\Form::class)->name('capituloForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value, \App\Http\Livewire\Artigo\Show::class)->name('artigoShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value . '/{action}/{artigo?}', \App\Http\Livewire\Artigo\Form::class)->name('artigoForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value, \App\Http\Livewire\Paragrafo\Show::class)->name('paragrafoShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value . '/{action}/{paragrafo?}', \App\Http\Livewire\Paragrafo\Form::class)->name('paragrafoForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value, \App\Http\Livewire\Inciso\Show::class)->name('incisoShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value . '/{action}/{inciso?}', \App\Http\Livewire\Inciso\Form::class)->name('incisoForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value, \App\Http\Livewire\Alinea\Show::class)->name('alineaShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value . '/{action}/{alinea?}', \App\Http\Livewire\Alinea\Form::class)->name('alineaForm');

    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Lead->value, \App\Http\Livewire\Lead\Show::class)->name('leadShow');
    Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Lead->value . '/{action}/{lead?}', \App\Http\Livewire\Lead\Form::class)->name('leadForm');
    Route::get('/leads/export', [\App\Http\Controllers\LeadController::class, 'export'])->name('leadExport');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });