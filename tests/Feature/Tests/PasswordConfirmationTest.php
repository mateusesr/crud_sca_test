<?php

use App\Models\User;
use App\Models\Aluno;

test('confirm password screen can be rendered', function () {
    $aluno = Aluno::factory()->create();

    $response = $this->actingAs($aluno)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $aluno = Aluno::factory()->create();

    $response = $this->actingAs($aluno)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $aluno = Aluno::factory()->create();

    $response = $this->actingAs($aluno)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
