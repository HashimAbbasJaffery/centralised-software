<?php

use App\Http\Controllers\Api\RecoveryController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\CardTypeController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\IntroletterController;
use App\Http\Controllers\Members\MemberController;
use App\Http\Controllers\MembersCardController;
use App\Http\Controllers\ThirdParty\GoogleServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get("/member/create", [MemberController::class, "create"])->name("member.create");
Route::get("/members", [MemberController::class, "index"])->name("member.manage");
Route::get("/member/{member}/update", [MemberController::class, "update"])->name("member.updated");
Route::get("/member/birthday", [BirthdayController::class, "index"])->name("member.birthdays");

Route::get("/membership-card/add-card", [CardTypeController::class, "create"])->name("card-type.add");
Route::get("/membership-cards", [CardTypeController::class, "index"])->name("card-type.index");
Route::get("/membership-card/{cardType}/update", [CardTypeController::class, "update"])->name("card-type.update");

Route::get("/club/create", [ClubController::class, "create"])->name("club.create");
Route::get("/clubs", [ClubController::class, "index"])->name("club.index");
Route::get("/club/{club}/update", [ClubController::class, "update"])->name("club.update");

Route::get("/durations", [DurationController::class, "index"])->name("duration.index");

Route::get("/introletters", [IntroletterController::class, "index"])->name("introletter.index");
Route::get("/introletter/{introletter}/invoice", [IntroletterController::class, "invoice"])->name("introletter.invoice");


Route::get("googlesheet", [GoogleServicesController::class, "save"]);

Route::get("/card/front", [MembersCardController::class, "index"])->name("card.front");
Route::get("/card/back", [MembersCardController::class, "back"])->name("card.back");

Route::get("/view-payment-schedule", [RecoveryController::class, "index"])->name("payment-schedule");
