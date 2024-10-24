<?php

use App\Http\Controllers\OrcamentosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

use App\Models\Orcamento;
use App\Models\Paciente;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/pacientes', [PacientesController::class, 'list'])->name('pacientes.list');
    Route::get('/pacientes/adicionar', [PacientesController::class, 'cadastrar'])->name('pacientes.cadastrar');
    Route::get('/pacientes/{id}/editar', [PacientesController::class, 'editar'])->name('pacientes.editar');
    Route::post('/pacientes', [PacientesController::class, 'store'])->name('pacientes.store');
    Route::put('/pacientes/{id}', [PacientesController::class, 'atualizar'])->name('pacientes.atualizar');
    Route::delete('/pacientes/{id}', [PacientesController::class, 'destroy'])->name('pacientes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/orcamentos', [OrcamentosController::class, 'list'])->name('orcamentos.list');
    Route::get('/orcamentos/adicionar', [OrcamentosController::class, 'criar'])->name('orcamentos.criar');
    Route::get('/orcamentos/{id}/editar', [OrcamentosController::class, 'editar'])->name('orcamentos.editar');
    Route::post('/orcamentos', [OrcamentosController::class, 'store'])->name('orcamentos.store');
    Route::put('/orcamentos/{id}', [OrcamentosController::class, 'atualizar'])->name('orcamentos.atualizar');
    Route::delete('/orcamentos/{id}', [OrcamentosController::class, 'destroy'])->name('orcamentos.destroy');
    Route::post('/orcamentos/{id}/update-status', [OrcamentosController::class, 'updateStatus'])->name('orcamentos.updateStatus');

    });

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {

    $totalOrcamentos = Orcamento::count();

    $orcamentosEmAberto = Orcamento::where('status', 'em aberto')->count();
    $orcamentosPendentes = Orcamento::where('status', 'pendente')->count();
    $orcamentosEmAndamento = Orcamento::where('status', 'em andamento')->count();
    $orcamentosConcluidos = Orcamento::where('status', 'concluído')->count();
    $orcamentosCancelados = Orcamento::where('status', 'cancelado')->count();

    $totalPacientes = Paciente::count();

    $novosPacientes = Paciente::whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->count();

    $valorTotalOrcamentos = Orcamento::sum('valor');

    return view('dashboard', compact(
        'totalOrcamentos',
        'orcamentosEmAberto',
        'orcamentosPendentes',
        'orcamentosEmAndamento',
        'orcamentosConcluidos',
        'orcamentosCancelados',
        'totalPacientes',
        'novosPacientes',
        'valorTotalOrcamentos'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');


