<?php

namespace App\Http\Controllers\Api\Auth;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function verifyOtp(User $user) {
        $otp = request()->otp;
        if(!$otp) {
            $this->apiResponse->error(404, "OTP not found!");
        }

        if($otp !== $user->otp) {
            return $this->apiResponse->error(403, "Invalid OTP");
        }

        return $this->apiResponse->success(200, "Verified");
    }
    public function otp(User $user) {
        $password = request()->password;
      
        if(!$user) {
            return $this->apiResponse->error(403, "Invalid Username");
        }

        if(!Hash::check($password, $user->password)) {
            return $this->apiResponse->error(403, "Invalid Password");
        }

        $otp = str_pad(random_int(0, pow(10, 6)-1), 6, '0', STR_PAD_LEFT);

        $user->otp = $otp;
        $user->otp_creation = now();
        $user->save();

        Mail::to($user->email)->queue(new SendOTP($user->otp));

        return $user;
    }
    public function login() {
        $username = request()->username;
        $password = request()->password;

        $user = User::where("username", $username)
                        ->first();
        
        $permissions = $user->permissions->map(fn($permission) => $permission->ability)->toArray();

        if(!$user || !Hash::check($password, $user->password)) {
            return $this->apiResponse->error(401, "User not found!");
        }

        $token = $user->createToken("api-token", $permissions)->plainTextToken;

        return $this->apiResponse->success("Api token has been created", [ "token" => $token ]);
    }

    public function logout(Request $request) {
        $token = $request->bearerToken();

        [$id, $token] = explode("|", $token);
        
        $personal_access_token = PersonalAccessToken::find($id);

        if(!$personal_access_token->exists()) {
            $this->apiResponse->error(404, "Token not found!");
        }

        $personal_access_token->delete();

        return $this->apiResponse->success("Successfully Logged");
    }
}
