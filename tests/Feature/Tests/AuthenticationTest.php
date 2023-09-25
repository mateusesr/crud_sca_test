<?php
use App\Models\Aluno;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use phpDocumentor\Reflection\PseudoTypes\True_;

test('login screen can be rendered', function () {
    $response = $this->get('/alunos');

    $response->assertStatus(200);
});

test('alunos can authenticate using the alunos screen', function () {
    $aluno = Aluno::factory()->create();

    $response = $this->post('/alunos', [
        'email' => $aluno->email
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('alunos can not authenticate with invalid login', function () {
    $aluno = User::factory()->create();

    $this->post('/alunos', [
        'email' => $aluno->email
    ]);

    $this->assertGuest();
});

