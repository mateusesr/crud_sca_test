<?php


use App\Models\Aluno;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Routes\web;


class AlunoRouteTest extends TestCase
{

    public function test_checking_the_home_page_route_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_checking_the_aluno_page_route_returns_a_successful_response(): void
    {
        $response = $this->get('../aluno');
        $response->assertStatus(200);
    }

    public function test_checking_the_aluno_edit_page_route_returns_a_successful_response(): void
    {
        $response = $this->get('../aluno/edit{id}');

        $response->assertStatus(200);
    }

    public function test_checking_the_aluno_create_page_route_returns_a_successful_response(): void
    {
        $response = $this->get('/aluno/novo');

        $response->assertStatus(200);
    }

    public function test_checking_invalid_route_returns_a_negative_response(): void
    {
        $response = $this->get('/rota_invalida_teste');

        $response->assertStatus(404);
    }
}
