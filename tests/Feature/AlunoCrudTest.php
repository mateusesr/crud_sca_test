<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;




class AlunoCrudTest extends TestCase
{
    public function test_aluno_can_create_new_aluno()
    {

        $response = $this->post('/alunos', [
            'nome' => 'Nome Teste',
            'email' => 'email@teste.com',

        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/alunos');
        $this->assertCount(1, Aluno::all());
        $this->assertDatabaseHas('aluno', ['nome' => '', 'email']);
    }

    public function test_aluno_can_update_aluno()
    {
        $aluno = User::factory()->create();
        Aluno::factory()->create();
        $this->assertCount(1, Aluno::all());
        $aluno = Aluno::first();
        $response = $this->actingAs($aluno)->put('/aluno' . $aluno->id, [
            'nome'  => 'Updated Aluno',
            'email' => 'Test',
            'categoria' => 5
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/aluno');
        $this->assertEquals('Updated Aluno', Aluno::first()->nome);
        $this->assertEquals('Test', Aluno::first()->email);
        $this->assertEquals(5, Aluno::first()->categoria);
    }

    public function test_aluno_can_delete_aluno()
    {
        $aluno = User::factory()->create();
        $aluno =  Aluno::factory()->create();
        $this->assertEquals(1, Aluno::count());
        $response = $this->actingAs($$aluno)->delete('/aluno' . $aluno->id);
        $response->assertStatus(302);
        $this->assertEquals(0, Aluno::count());
    }

    public function test_auth_aluno_can_access_dashboard()
    {
        $aluno = User::factory()->create();

        $response = $this->actingAs($aluno)->get('/');

        $response->assertStatus(200);
    }

    public function test_unath_aluno_cannot_access_dashboard()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
