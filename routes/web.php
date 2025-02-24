<?php

use App\Http\Controllers\ClassificacaoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PlayoffController;
use App\Http\Controllers\TimesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------->------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/criar/times', [TimesController::class, 'index'])->name('criar.times');
Route::get('/times/{modo}', [TimesController::class, 'adicionarSelecoes'])->name('add.selecoes');
Route::post('/times/add/{modo?}', [TimesController::class, 'adicionarTimes'])->name('adicionar.times');
Route::get('/times/mundial/add/{modo?}', [TimesController::class, 'adicionarTimesMundial'])->name('add.grupos.super');
Route::get('/grupos/{modo}', [GrupoController::class, 'adicionarGrupos'])->name('add.grupos');
Route::get('/partidas/{modo?}', [PartidaController::class, 'adicionarPartidas'])->name('add.partidas');
Route::get('/classificacao/{modo?}', [ClassificacaoController::class, 'adicionarClassificacao'])->name('add.classificacao');
Route::get('/classificacao/resultado/{rodada}', [ClassificacaoController::class, 'index'])->name('classificacao.index');
Route::get('/partidas/rodada/{rodada}', [PartidaController::class, 'mostrarPartidasPorRodada'])->name('partidas.rodada');
Route::post('/partidas/salvar-resultado', [PartidaController::class, 'salvarResultado'])->name('partidas.salvar-resultado');
Route::get('/playoffs/{fase}', [PlayoffController::class, 'gerarPlayoffs'])->name('add.playoff');
Route::get('/playoffs/partidas/{fase}', [PlayoffController::class, 'mostrarPartidasPorFase'])->name('playoff.partidas');
Route::post('/playoffs/salvar-resultado', [PlayoffController::class, 'salvarResultado'])->name('playoffs.salvar-resultado');
Route::post('/playoffs/penaltis{playoffs}', [PlayoffController::class, 'penaltis'])->name('playoffs.penaltis');
Route::post('/playoff/add', [PlayoffController::class, 'addPlayoff'])->name('add.playoff.fase');
