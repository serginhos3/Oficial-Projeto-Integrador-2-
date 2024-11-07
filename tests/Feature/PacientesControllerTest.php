<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PacientesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_listar_pacientes()
    {
        $response = $this->get(route('pacientes.list'));

        $response->assertStatus(200)
            ->assertViewIs('pacientes.list');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_tela_de_cadastro_de_paciente_esta_acessivel()
    {
        $response = $this->get(route('pacientes.cadastrar'));

        $response->assertStatus(200)
            ->assertViewIs('pacientes.cadastrar');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_cadastrar_novo_paciente()
    {
        $response = $this->post(route('pacientes.store'), [
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

        $response->assertRedirect(route('pacientes.list'))
            ->assertSessionHas('status', 'Paciente cadastrado com sucesso!');
        $this->assertDatabaseHas('pacientes', ['email' => 'paciente@teste.com']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_tela_de_edicao_de_paciente_esta_acessivel()
    {

        $response = $this->post(route('pacientes.store'), [
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

        $paciente = \App\Models\Paciente::where('email', 'paciente@teste.com')->first();

        $response = $this->get(route('pacientes.editar', $paciente->id));

        $response->assertStatus(200)
            ->assertViewIs('pacientes.editar');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_atualizar_paciente()
    {

        $paciente = Paciente::create([
            'nome' => 'Paciente Antigo',
            'email' => 'antigo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Antiga',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Antigo',
            'cidade' => 'Cidade Antiga',
            'estado' => 'SP',
            'datanascimento' => '1990-01-01',
        ]);

        $response = $this->put(route('pacientes.atualizar', $paciente->id), [
            'nome' => 'Paciente Atualizado',
            'email' => 'atualizado@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '87654321',
            'logradouro' => 'Rua Atualizada',
            'numero' => '321',
            'complemento' => 'Apto 2',
            'bairro' => 'Bairro Atualizado',
            'cidade' => 'Cidade Atualizada',
            'estado' => 'RJ',
            'datanascimento' => '1990-01-01',
        ]);

        $response->assertRedirect(route('pacientes.list'))
            ->assertSessionHas('status', 'Paciente atualizado com sucesso!');

        $this->assertDatabaseHas('pacientes', [
            'id' => $paciente->id,
            'nome' => 'Paciente Atualizado',
            'email' => 'atualizado@teste.com'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_excluir_paciente()
    {

        $paciente = Paciente::create([
            'nome' => 'Paciente a Excluir',
            'email' => 'excluir@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua a Excluir',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro a Excluir',
            'cidade' => 'Cidade a Excluir',
            'estado' => 'SP',
            'datanascimento' => '1990-01-01',
        ]);

        $response = $this->delete(route('pacientes.destroy', $paciente->id));

        $response->assertRedirect(route('pacientes.list'))
            ->assertSessionHas('status', 'Paciente excluído com sucesso!');

        $this->assertDatabaseMissing('pacientes', ['id' => $paciente->id]);
    }
}
