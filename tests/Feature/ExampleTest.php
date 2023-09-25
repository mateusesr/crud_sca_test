<?php

it('Retorne uma resposta sucesso', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
