<?php

use App\Http\Controllers\ClassificacaoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartidaController;
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
Route::get('/times', [TimesController::class, 'adicionarSelecoes'])->name('add.selecoes');
Route::get('/grupos', [GrupoController::class, 'adicionarGrupos'])->name('add.grupos');
Route::get('/partidas', [PartidaController::class, 'adicionarPartidas'])->name('add.partidas');
Route::get('/classificacao', [ClassificacaoController::class, 'adicionarClassificacao'])->name('add.classificacao');
Route::get('/classificacao/resultado/{rodada}', [ClassificacaoController::class, 'index'])->name('classificacao.index');
Route::get('/partidas/rodada/{rodada}', [PartidaController::class, 'mostrarPartidasPorRodada'])->name('partidas.rodada');
Route::post('/partidas/salvar-resultado', [PartidaController::class, 'salvarResultado'])->name('partidas.salvar-resultado');
