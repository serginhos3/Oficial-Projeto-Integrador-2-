<?php

namespace App\Http\Controllers;

use App\Models\Orcamento; // Importa a classe Orçamento
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class OrcamentosController extends Controller
{
    /**
     * Exibe a lista de orçamento.
     */
    public function list(Request $request): View
    {
        $orcamentos = Orcamento::all();
        return view('orcamentos.list', compact('orcamentos')); // Passa a lista de orçamento para a view
    }

    /**
     * Exibe o formulário para cadastrar um novo orçamento.
     */
    public function criar(): View
    {
        return view('orcamentos.criar');
    }

    /**
     * Processa o cadastro de um novo orçamento.
     */
    public function store(Request $request)
    {
        // Validar os dados de entrada
        $validatedData = $request->validate([
            'paciente' => 'required|string',
            'valor' => 'required|string', // Receber como string inicialmente
            'procedimento' => 'required|string',
            'dentista' => 'required|string',
            'status' => 'required|string',
            'data' => 'required|date',
        ]);
    
        // Processar o valor para o formato correto (decimal)
        $valor = str_replace(['R$', ' ', ','], ['', '', '.'], $validatedData['valor']);
    
        // Criar o orçamento
        Orcamento::create([
            'paciente' => $validatedData['paciente'],
            'valor' => $valor,
            'procedimento' => $validatedData['procedimento'],
            'dentista' => $validatedData['dentista'],
            'status' => $validatedData['status'],
            'data' => $validatedData['data'],
        ]);
    
        return redirect()->route('orcamentos.criar')->with('status', 'Orçamento criado com sucesso!');
    }
        
    /**
     * Exibe o formulário para editar um orçamento.
     */
    public function editar($id): View
    {
        $orcamento = Orcamento::findOrFail($id); // Obtém o orçamento ou retorna 404
        return view('orcamentos.editar', compact('orcamento')); // Passa o orçamento para a view
    }

    /**
     * Atualiza os dados de um orçamento.
     */
    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'paciente' => 'required|string|max:255',
            'valor' => 'required|valor|unique:orcamentos,valor,' . $id,
            'procedimento' => 'nullable|string|max:15',
            'dentista' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'data' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orcamentos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Atualiza o orçamento
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->update($request->only('paciente', 'valor', 'procedimento', 'dentista', 'status', 'data'));

        // Redirecionar para a listagem de orçamentos com uma mensagem de sucesso
        return redirect()->route('orcamentos.list')->with('status', 'Orçamento atualizado com sucesso!');
    }

    /**
     * Remove um orçamento.
     */
    public function destroy($id)
    {
        $orcamento = Orcamento::findOrFail($id); // Obtém o paciente ou retorna 404
        $orcamento->delete(); // Deleta o paciente

        return redirect()->route('orcamentos.list')->with('status', 'Orçamento excluído com sucesso!');
    }
}
