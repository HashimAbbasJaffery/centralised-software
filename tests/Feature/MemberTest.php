<?php

use App\Models\User;

test('example', function () {

    $user = User::factory()->create();
    $token = $user->createToken("api-token")->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer' . $token)
                        ->postJson('/api/member/create', []);
});
