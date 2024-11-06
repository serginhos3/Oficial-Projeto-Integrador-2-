<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{

    public function list(Request $request): View
    {
        $pacientes = Paciente::all();
        return view('pacientes.list', compact('pacientes'));
    }


    public function cadastrar(): View
    {
        return view('pacientes.cadastrar');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email|max:255',
            'telefone' => 'nullable|string|regex:/^\d{2} \d{5}-\d{4}$/|max:13',
            'cep' => 'nullable|string|size:8',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|size:2',
            'datanascimento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pacientes.cadastrar')
                ->withErrors($validator)
                ->withInput();
        }

        Paciente::create($request->only('nome', 'email', 'telefone', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'datanascimento'));

        return redirect()->route('pacientes.list')->with('status', 'Paciente cadastrado com sucesso!');
    }


    public function editar($id): View
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.editar', compact('paciente'));
    }

    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $id,
            'telefone' => 'nullable|string|max:15',
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',    
            'datanascimento' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pacientes.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->only('nome', 'email', 'telefone', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'datanascimento'));

        return redirect()->route('pacientes.list')->with('status', 'Paciente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.list')->with('status', 'Paciente excluído com sucesso!');
    }
}
