<?php

namespace App\Service;

use App\ApiResponse;
use App\Exceptions\DontHaveAccessException;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ApiResponse $apiResponse)
    {
        //
    }

    public function isAllowedToPerformAction($ability) {
        return true;
        $token = PersonalAccessToken::findToken(request()->bearerToken());
        if($token->cant($ability)) {
            throw new DontHaveAccessException();
        }
    }
    public function getAbilities() {
        $token = PersonalAccessToken::find(request()->bearerToken());
        return $token->abilities;
    }
}
