<?php

namespace App\Http\Controllers;

use App\Models\Orcamento; // Importa a classe Orçamento
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF;

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
        // Remover 'R$', espaços e substituir vírgula por ponto
        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $validatedData['valor']);

        // Certificar-se de que o valor é numérico antes de salvar
        if (is_numeric($valor)) {
            // Criar o orçamento
            Orcamento::create([
                'paciente' => $validatedData['paciente'],
                'valor' => (float) $valor, // Converter para número decimal
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

    public function updateStatus(Request $request, $id)
    {
        // Validar o status enviado
        $request->validate([
            'status' => 'required|string',
        ]);

        // Encontrar o orçamento pelo ID
        $orcamento = Orcamento::find($id);

        if ($orcamento) {
            // Atualizar o status
            $orcamento->status = $request->input('status');
            $orcamento->save();

            // Retornar uma resposta de sucesso
            return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso!']);
        }

        // Retornar erro se o orçamento não for encontrado
        return response()->json(['success' => false, 'message' => 'Orçamento não encontrado.'], 404);
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
        // Validar os dados de entrada
        $validator = Validator::make($request->all(), [
            'paciente' => 'required|string|max:255',
            'valor' => 'required|string', // Receber como string inicialmente
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

        // Processar o valor para o formato correto (decimal)
        // Remover 'R$', espaços e substituir vírgula por ponto
        $valor = str_replace(['R$', '.', ','], ['', '', '.'], $request->input('valor'));

        // Certificar-se de que o valor é numérico antes de salvar
        if (!is_numeric($valor)) {
            return redirect()->route('orcamentos.editar', $id)
                ->withErrors(['valor' => 'O valor informado é inválido.'])
                ->withInput();
        }

        // Atualiza o orçamento
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->update([
            'paciente' => $request->input('paciente'),
            'valor' => (float) $valor, // Converter para número decimal
            'procedimento' => $request->input('procedimento'),
            'dentista' => $request->input('dentista'),
            'status' => $request->input('status'),
            'data' => $request->input('data'),
        ]);

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
