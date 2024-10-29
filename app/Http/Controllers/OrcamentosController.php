<?php

namespace App\Http\Controllers;

use App\Models\Orcamento; // Importa a classe Orçamento
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Paciente;

class OrcamentosController extends Controller
{
    /**
     * Exibe a lista de orçamento.
     */
    public function list(Request $request): View
    {
        $orcamentos = Orcamento::all();
        return view('orcamentos.list', compact('orcamentos'));
    }

    /**
     * Exibe o formulário para cadastrar um novo orçamento.
     */
    public function criar(): View
    {

        $pacientes = Paciente::all(); // Carrega todos os pacientes
        return view('orcamentos.criar', compact('pacientes'));
    }

    /**
     * Processa o cadastro de um novo orçamento.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'idpaciente' => 'required|exists:pacientes,id', // Valida 'idpaciente' em vez de 'paciente'
            'valor' => 'required|string',
            'procedimento' => 'required|string',
            'dentista' => 'required|string',
            'status' => 'required|string',
            'data' => 'required|date',
        ]);
    
        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $validatedData['valor']);

        $pacienteNome = \App\Models\Paciente::where('id', $validatedData['idpaciente'])->value('nome');
    
        if (is_numeric($valor)) {
            Orcamento::create([
                'idpaciente' => $validatedData['idpaciente'],
                'paciente' => $pacienteNome,  // Verifique aqui
                'valor' => (float) $valor,
                'procedimento' => $validatedData['procedimento'],
                'dentista' => $validatedData['dentista'],
                'status' => $validatedData['status'],
                'data' => $validatedData['data'],
            ]);
    
            return redirect()->route('orcamentos.list')->with('status', 'Orçamento criado com sucesso!');
        } else {
            return back()->withErrors(['valor' => 'O valor informado é inválido.']);
        }
    }

    public function buscarPacientes(Request $request)
    {
        $search = $request->input('query');
        $pacientes = Paciente::where('nome', 'LIKE', "%{$search}%")->get();

        return response()->json($pacientes);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $orcamento = Orcamento::find($id);

        if ($orcamento) {
            $orcamento->status = $request->input('status');
            $orcamento->save();


            return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso!']);
        }

        return response()->json(['success' => false, 'message' => 'Orçamento não encontrado.'], 404);
    }

    /**
     * Exibe o formulário para editar um orçamento.
     */
    public function editar($id): View
    {
        $orcamento = Orcamento::findOrFail($id);
        return view('orcamentos.editar', compact('orcamento'));
    }

    /**
     * Atualiza os dados de um orçamento.
     */
    public function atualizar(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'paciente' => 'required|string|max:255',
            'valor' => 'required|string',
            'procedimento' => 'nullable|string|max:255',
            'dentista' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'data' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orcamentos.editar', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $request->input('valor'));

        if (!is_numeric($valor)) {
            return redirect()->route('orcamentos.editar', $id)
                ->withErrors(['valor' => 'O valor informado é inválido.'])
                ->withInput();
        }

        $orcamento = Orcamento::findOrFail($id);
        $orcamento->update([
            // 'paciente' => $request->input('paciente'),
            'valor' => (float) $valor,
            'procedimento' => $request->input('procedimento'),
            'dentista' => $request->input('dentista'),
            'status' => $request->input('status'),
            'data' => $request->input('data'),
        ]);

        return redirect()->route('orcamentos.list')->with('status', 'Orçamento atualizado com sucesso!');
    }

    /**
     * Remove um orçamento.
     */
    public function destroy($id)
    {
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->delete();

        return redirect()->route('orcamentos.list')->with('status', 'Orçamento excluído com sucesso!');
    }

    public function gerarPdf($id)
    {

        $orcamento = Orcamento::findOrFail($id);

        $logoPath = public_path('/img/logo.jpg');

        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $pdf = PDF::loadView('orcamentos.pdf', compact('orcamento', 'logoSrc'));

        return $pdf->download('orcamento_' . $orcamento->id . '.pdf');
    }
}
