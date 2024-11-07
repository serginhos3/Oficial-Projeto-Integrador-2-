<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrcamentosControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_listar_orcamentos()
    {
        $response = $this->get(route('orcamentos.list'));

        $response->assertStatus(200)
            ->assertViewIs('orcamentos.list');
    }

    public function test_tela_de_criacao_de_orcamento_esta_acessivel()
    {
        $response = $this->get(route('orcamentos.criar'));

        $response->assertStatus(200)
            ->assertViewIs('orcamentos.criar');
    }

    public function test_criar_orcamento()
    {
        $paciente = \App\Models\Paciente::create([
            'nome' => 'Paciente Teste',
            'email' => 'paciente@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datanascimento' => '2000-01-01',
        ]);

        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $orcamento = \App\Models\Orcamento::first();

        $this->assertDatabaseHas('orcamentos', [
            'id' => $orcamento->id,
            'valor' => 500.00,
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
            'idpaciente' => $paciente->id,
        ]);
    }


    public function test_atualizar_status_orcamento()
    {

        \App\Models\Paciente::create([
            'nome' => 'Paciente Teste',
            'email' => 'paciente@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datanascimento' => '2000-01-01',
        ]);

        $paciente = \App\Models\Paciente::first();

        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $orcamento = \App\Models\Orcamento::first();

        $response = $this->post(route('orcamentos.updateStatus', $orcamento->id), [
            'status' => 'Em Andamento',
        ]);

        $response->assertJson(['success' => true, 'message' => 'Status atualizado com sucesso!']);

        $this->assertDatabaseHas('orcamentos', ['id' => $orcamento->id, 'status' => 'Em Andamento']);
    }


    public function test_tela_de_edicao_de_orcamento_esta_acessivel()
    {

        \App\Models\Paciente::create([
            'nome' => 'Paciente Teste',
            'email' => 'paciente@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datanascimento' => '2000-01-01',
        ]);

        $paciente = \App\Models\Paciente::first();

        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'paciente' => "elza",
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $orcamento = \App\Models\Orcamento::first();

        $response = $this->get(route('orcamentos.editar', $orcamento->id));
        $response->assertStatus(200);
    }

    public function test_atualizar_orcamento()
    {

        \App\Models\Paciente::create([
            'nome' => 'Paciente Teste',
            'email' => 'paciente@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datanascimento' => '2000-01-01',
        ]);

        $paciente = \App\Models\Paciente::first();

        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $orcamento = \App\Models\Orcamento::first();

        $response = $this->put(route('orcamentos.atualizar', $orcamento->id), [
            'valor' => 'R$ 800,00',
            'paciente' => 'elza',
            'procedimento' => 'Extração',
            'dentista' => 'Dr. Teste 2',
            'status' => 'Concluído',
            'data' => '2024-11-10',
        ]);

        $response->assertRedirect(route('orcamentos.list'))
            ->assertSessionHas('status', 'Orçamento atualizado com sucesso!');
    }

    public function test_excluir_orcamento()
    {
        $paciente = \App\Models\Paciente::create([
            'nome' => 'Paciente Teste',
            'email' => 'paciente@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datanascimento' => '2000-01-01',
        ]);

        $orcamento = \App\Models\Orcamento::create([
            'idpaciente' => $paciente->id,
            'paciente' => $paciente->nome,
            'valor' => 500.00,
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $response = $this->delete(route('orcamentos.destroy', $orcamento->id));

        $response->assertRedirect(route('orcamentos.list'))
            ->assertSessionHas('status', 'Orçamento excluído com sucesso!');

        $this->assertDatabaseMissing('orcamentos', ['id' => $orcamento->id]);
    }

}
