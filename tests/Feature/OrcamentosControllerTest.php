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
        $this->user = User::factory()->create(); // Criação de um usuário autenticado
        $this->actingAs($this->user); // Autenticação do usuário
    }

    /** @test */
    public function test_listar_orcamentos()
    {
        $response = $this->get(route('orcamentos.list'));

        $response->assertStatus(200)
            ->assertViewIs('orcamentos.list');
    }

    /** @test */
    public function test_tela_de_criacao_de_orcamento_esta_acessivel()
    {
        $response = $this->get(route('orcamentos.criar'));

        $response->assertStatus(200)
            ->assertViewIs('orcamentos.criar');
    }

    /** @test */
    public function test_criar_orcamento()
    {
        // Cria um paciente para associar ao orçamento
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

        // Realiza a criação do orçamento associado ao paciente criado
        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,  // Utiliza o ID do paciente criado
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        // Recupera o orçamento mais recente no banco de dados
        $orcamento = \App\Models\Orcamento::first();

        // Verifica se o orçamento foi salvo no banco de dados
        $this->assertDatabaseHas('orcamentos', [
            'id' => $orcamento->id,
            'valor' => 500.00,  // O valor foi convertido para o formato float
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
            'idpaciente' => $paciente->id,  // Verifica se o paciente correto foi associado
        ]);
    }


    /** @test */
    /** @test */
    public function test_atualizar_status_orcamento()
    {
        // Criação de um paciente
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

        // Recupera o paciente criado
        $paciente = \App\Models\Paciente::first();

        // Criação de um orçamento para o paciente
        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        // Recupera o orçamento criado
        $orcamento = \App\Models\Orcamento::first();

        // Atualiza o status do orçamento via POST
        $response = $this->post(route('orcamentos.updateStatus', $orcamento->id), [
            'status' => 'Em Andamento',
        ]);

        // Verifica a resposta JSON
        $response->assertJson(['success' => true, 'message' => 'Status atualizado com sucesso!']);

        // Verifica se o status do orçamento foi atualizado no banco
        $this->assertDatabaseHas('orcamentos', ['id' => $orcamento->id, 'status' => 'Em Andamento']);
    }


    /** @test */
    public function test_tela_de_edicao_de_orcamento_esta_acessivel()
    {

        // Criação de um paciente
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

        // Recupera o paciente criado
        $paciente = \App\Models\Paciente::first();

        // Criação de um orçamento para o paciente
        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'paciente' => "elza",
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        // Recupera o orçamento criado
        $orcamento = \App\Models\Orcamento::first();

        $response = $this->get(route('orcamentos.editar', $orcamento->id));
        $response->assertStatus(200);
    }

    /** @test */
    /** @test */
    public function test_atualizar_orcamento()
    {
        // Criação de um paciente
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

        // Recupera o paciente criado
        $paciente = \App\Models\Paciente::first();

        // Criação de um orçamento para o paciente
        $this->post(route('orcamentos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idpaciente' => $paciente->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        // Recupera o orçamento criado
        $orcamento = \App\Models\Orcamento::first();


        // Atualiza o orçamento
        $response = $this->put(route('orcamentos.atualizar', $orcamento->id), [
            'valor' => 'R$ 800,00',  // Valor convertido para float
            'paciente' => 'elza',
            'procedimento' => 'Extração',
            'dentista' => 'Dr. Teste 2',
            'status' => 'Concluído',
            'data' => '2024-11-10',
        ]);

        // Verifica o redirecionamento e a mensagem de sucesso
        $response->assertRedirect(route('orcamentos.list'))
            ->assertSessionHas('status', 'Orçamento atualizado com sucesso!');
    }

    /** @test */
    public function test_excluir_orcamento()
    {
        // Criação de um paciente para garantir que o orçamento esteja associado a um paciente válido
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

        // Criação de um orçamento associado ao paciente criado
        $orcamento = \App\Models\Orcamento::create([
            'idpaciente' => $paciente->id,  // Associando o orçamento ao paciente
            'paciente' => $paciente->nome,  // Passando o nome do paciente
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
