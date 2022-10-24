<?php

use App\Http\Controllers\UserController;
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

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value, \App\Http\Livewire\Pergunta\Show::class)->name('perguntaShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value . '/{action}/{pergunta?}', \App\Http\Livewire\Pergunta\Form::class)->name('perguntaForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value, \App\Http\Livewire\BaseJuridica\Show::class)->name('baseJuridicaShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value . '/{action}/{baseJuridica?}', \App\Http\Livewire\BaseJuridica\Form::class)->name('baseJuridicaForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value, \App\Http\Livewire\Capitulo\Show::class)->name('capituloShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value . '/{action}/{capitulo?}', \App\Http\Livewire\Capitulo\Form::class)->name('capituloForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value, \App\Http\Livewire\Artigo\Show::class)->name('artigoShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value . '/{action}/{artigo?}', \App\Http\Livewire\Artigo\Form::class)->name('artigoForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value, \App\Http\Livewire\Paragrafo\Show::class)->name('paragrafoShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value . '/{action}/{paragrafo?}', \App\Http\Livewire\Paragrafo\Form::class)->name('paragrafoForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value, \App\Http\Livewire\Inciso\Show::class)->name('incisoShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value . '/{action}/{inciso?}', \App\Http\Livewire\Inciso\Form::class)->name('incisoForm')->middleware('auth');

Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value, \App\Http\Livewire\Alinea\Show::class)->name('alineaShow')->middleware('auth');
Route::get('/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value . '/{action}/{alinea?}', \App\Http\Livewire\Alinea\Form::class)->name('alineaForm')->middleware('auth');