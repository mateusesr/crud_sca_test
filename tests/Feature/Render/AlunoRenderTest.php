<?php

use PHPUnit\Event\Code\Test;
use Tests\TestCase;

it('home screen can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
test('aluno screen can be rendered', function () {
    $response = $this->get('/alunos');

    $response->assertStatus(200);
});
test('edit screen can be rendered', function () {
    $response = $this->get('/alunos/edit/{$id}');

    $response->assertStatus(200);
});
test('aluno novo screen can be rendered', function () {
    $response = $this->get('/alunos/novo');

    $response->assertStatus(200); 
});
test('invalid screen can be rendered', function () {
    $response = $this->get('/tela_invalida_teste');

    $response->assertStatus(404);
});