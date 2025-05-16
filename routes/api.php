<?php

use App\Http\Controllers\Api\BirthdayController;
use App\Http\Controllers\Api\CardTypeController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\DurationController;
use App\Http\Controllers\Api\IntroletterController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/members", [MemberController::class, "index"])->name("api.member.index");
Route::post("/member/create", [MemberController::class, "store"])->name("api.member.create");
Route::delete("/member/{member}/delete", [MemberController::class, "destroy"])->name("api.member.delete");
Route::put("/member/{member}/update", [MemberController::class, "update"])->name("api.member.update");
Route::get("/member/birthdays", [BirthdayController::class, "index"])->name("api.member.birthday");

Route::post("/membership-card/add-card", [CardTypeController::class, "store"])->name("api.card.add");
Route::get("/membership-cards", [CardTypeController::class, "index"])->name("api.card.index");
Route::get("/membership-cards/all", [CardTypeController::class, "getAll"])->name("api.card.all");
Route::delete("/membership-card/{cardType}/delete", [CardTypeController::class, "destroy"])->name("api.card.delete");
Route::put("/membership-card/{cardType}/update", [CardTypeController::class, "update"])->name("api.card.update");

Route::post("/club/create", [ClubController::class, "store"])->name("api.club.create");
Route::get("/clubs", [ClubController::class, "index"])->name("api.club.index");
Route::delete("/club/{club}/delete", [ClubController::class, "delete"])->name("api.club.delete");

Route::get("/durations", [DurationController::class, "index"])->name("api.duration.index");
Route::post("/duration/create", [DurationController::class, "store"])->name("api.duration.create");
Route::delete("/duration/{duration}/delete", [DurationController::class, "delete"])->name("api.duration.delete");
Route::put("/duration/{duration}/update", [DurationController::class, "update"])->name("api.duration.update");

Route::get("/introletters", [IntroletterController::class, "index"])->name("api.introletter.index");
Route::delete("/introletter/{introletter}/delete", [IntroletterController::class, "delete"])->name("api.introletter.delete");

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
