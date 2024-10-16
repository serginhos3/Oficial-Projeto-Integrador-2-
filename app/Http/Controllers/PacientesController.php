<?php

namespace App\Http\Controllers;

use App\Models\Paciente; // Importa a classe Paciente
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{
    /**
     * Exibe a lista de pacientes.
     */
    public function list(Request $request): View
    {
        $pacientes = Paciente::all(); // Obtém todos os pacientes
        return view('pacientes.list', compact('pacientes')); // Passa a lista de pacientes para a view
    }

    /**
     * Exibe o formulário para cadastrar um novo paciente.
     */
    public function cadastrar(): View
    {
        return view('pacientes.cadastrar');
    }

    /**
     * Processa o cadastro de um novo paciente.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email',
            'telefone' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
            'datanascimento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pacientes.cadastrar')
                ->withErrors($validator)
                ->withInput();
        }

        // Criação do paciente
        Paciente::create($request->only('nome', 'email', 'telefone', 'endereco', 'datanascimento'));

        // Redirecionar para a listagem de pacientes com uma mensagem de sucesso
        return redirect()->route('pacientes.list')->with('status', 'Paciente cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um paciente.
     */
    public function editar($id): View
    {
        $paciente = Paciente::findOrFail($id); // Obtém o paciente ou retorna 404
        return view('pacientes.editar', compact('paciente')); // Passa o paciente para a view
    }

    /**
     * Atualiza os dados de um paciente.
     */
    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $id,
            'telefone' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
            'datanascimento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pacientes.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Atualiza o paciente
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->only('nome', 'email', 'telefone', 'endereco', 'datanascimento'));

        // Redirecionar para a listagem de pacientes com uma mensagem de sucesso
        return redirect()->route('pacientes.list')->with('status', 'Paciente atualizado com sucesso!');
    }

    /**
     * Remove um paciente.
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id); // Obtém o paciente ou retorna 404
        $paciente->delete(); // Deleta o paciente

        return redirect()->route('pacientes.list')->with('status', 'Paciente excluído com sucesso!');
    }
}
