<?php

use App\Http\Controllers\Members\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/member/create", [MemberController::class, "create"])->name("member.create");