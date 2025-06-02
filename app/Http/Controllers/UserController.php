<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view("Users.index");
    }
    public function create() {
        return view("Users.create");
    }
    public function update(User $user) {
        $permissions = $user->permissions->pluck("ability")->toArray();
        return view("Users.update", compact("user", "permissions"));
    }
}
