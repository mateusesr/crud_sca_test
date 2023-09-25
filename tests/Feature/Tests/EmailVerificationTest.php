<?php

use App\Models\Aluno;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('email verification screen can be rendered', function () {
    $aluno = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $response = $this->actingAs($aluno)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    $aluno = User::factory()->create([
        'email_verified_at' => null,
    ]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $aluno->id, 'hash' => sha1($aluno->email)]
    );

    $response = $this->actingAs($aluno)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($aluno->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $aluno = Aluno::factory()->create([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $aluno->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($aluno)->get($verificationUrl);

    expect($aluno->fresh()->hasVerifiedEmail())->toBeFalse();
});
