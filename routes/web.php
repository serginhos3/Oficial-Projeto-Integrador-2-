<?php

use App\Http\Controllers\OrcamentosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/pacientes', [PacientesController::class, 'list'])->name('pacientes.list'); // Listar pacientes
    Route::get('/pacientes/adicionar', [PacientesController::class, 'cadastrar'])->name('pacientes.cadastrar'); // Para adicionar
    Route::get('/pacientes/{id}/editar', [PacientesController::class, 'editar'])->name('pacientes.editar'); // Rota para editar
    Route::post('/pacientes', [PacientesController::class, 'store'])->name('pacientes.store'); // Para processar o cadastro
    Route::put('/pacientes/{id}', [PacientesController::class, 'atualizar'])->name('pacientes.atualizar'); // Rota para atualizar
    Route::delete('/pacientes/{id}', [PacientesController::class, 'destroy'])->name('pacientes.destroy'); // Rota para deletar
});

Route::middleware('auth')->group(function () {
    Route::get('/orcamentos', [OrcamentosController::class, 'list'])->name('orcamentos.list'); // Listar pacientes
    Route::get('/orcamentos/adicionar', [OrcamentosController::class, 'criar'])->name('orcamentos.criar'); // Para adicionar
    Route::get('/orcamentos/{id}/editar', [OrcamentosController::class, 'editar'])->name('orcamentos.editar'); // Rota para editar
    Route::post('/orcamentos', [OrcamentosController::class, 'store'])->name('orcamentos.store'); // Para processar o cadastro
    Route::put('/orcamentos/{id}', [OrcamentosController::class, 'atualizar'])->name('orcamentos.atualizar'); // Rota para atualizar
    Route::delete('/orcamentos/{id}', [OrcamentosController::class, 'destroy'])->name('orcamentos.destroy'); // Rota para deletar
    Route::post('/orcamentos/{id}/update-status', [OrcamentosController::class, 'updateStatus'])->name('orcamentos.updateStatus');

    });

require __DIR__ . '/auth.php';

