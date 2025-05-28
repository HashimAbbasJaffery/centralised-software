<?php

namespace App\Http\Controllers\Api\Auth;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function login() {
        $username = request()->username;
        $password = request()->password;

        $user = User::where("name", $username)
                        ->first();

        if(!$user || !Hash::check($password, $user->password)) {
            return $this->apiResponse->error(401, "User not found!");
        }

        $token = $user->createToken("api-token")->plainTextToken;

        return $this->apiResponse->success("Api token has been created", [ "token" => $token ]);
    }
}
