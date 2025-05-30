<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\UserService;
use DB;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Validator;

class UserController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse, protected UserService $user) {}
    public function index() {
        $keyword = request()->keyword;
        $users = User::where("username", "like", "%$keyword%")->paginate(8);

        return UserResource::collection($users);
    }

    public function store() {
        $validator = Validator::make(request()->all(), [
            "username" => [ "required" ],
            "fullname" => [ "required" ],
            "password" => [ "required" ],
            "permissions" => [ "required" ]
        ]);

        if($validator->fails()) {
            $this->apiResponse->error(422, $validator->errors());
        }


        DB::transaction(function() use($validator) {

            $user = User::create($validator->validated());

            $user->givePermissionsToUser(json_decode(request()->permissions));

        });

        return $this->apiResponse->success("User has been created!");
    }
    public function privileges() {
        return $this->user->getAbilities();
    }
}
