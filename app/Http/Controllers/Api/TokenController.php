<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}

    public function check() {
        $token = request()->bearerToken();
        
        $access_token = PersonalAccessToken::findToken($token);
        if(!$access_token) {
            return $this->apiResponse->error(401, "Token has been expired");
        }
        return $this->apiResponse->success(200, "Token is valid!");
    }

    public function check_token() {
        $token = request()->bearerToken();

        $access_token = PersonalAccessToken::findToken($token);
        if(!$access_token) {
            return $this->apiResponse->error(401, "Token has been expired");
        }
        
        return $this->apiResponse->success(200, "Token is valid!");
    }
}
