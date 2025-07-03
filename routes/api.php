<?php

use App\ApiResponse;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BirthdayController;
use App\Http\Controllers\Api\CardTypeController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\ComplainController;
use App\Http\Controllers\Api\ComplainQuestionController;
use App\Http\Controllers\Api\ComplainTypeController;
use App\Http\Controllers\Api\DurationController;
use App\Http\Controllers\Api\FamilySheetController;
use App\Http\Controllers\Api\IntroletterController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ReceiptController;
use App\Http\Controllers\Api\RecoveryController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\ThirdParty\GoogleServicesController;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::patch("/member/{member}/patch", function(Member $member) {
    $attribute = request()->attribute;
    $value = request()->value;

    $member->$attribute = $value;
    $member->save();
    
    return request()->all();
})->name("member.patch");
Route::get("/member/all", [MemberController::class, "getAllMembers"])->name("api.member.all");
Route::get("/member/{member}/get", [MemberController::class, "getById"])->name("api.member.getById");
Route::get("/members/all", [MemberController::class, "getAll"])->name("api.member.all");
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
Route::get("/child/memberships", [CardTypeController::class, "childMemberships"])->name("api.card.child");

Route::post("/club/create", [ClubController::class, "store"])->name("api.club.create");
Route::get("/clubs", [ClubController::class, "index"])->name("api.club.index");
Route::delete("/club/{club}/delete", [ClubController::class, "delete"])->name("api.club.delete");

Route::get("/durations", [DurationController::class, "index"])->name("api.duration.index");
Route::post("/duration/create", [DurationController::class, "store"])->name("api.duration.create");
Route::delete("/duration/{duration}/delete", [DurationController::class, "delete"])->name("api.duration.delete");
Route::put("/duration/{duration}/update", [DurationController::class, "update"])->name("api.duration.update");

Route::get("/introletters", [IntroletterController::class, "index"])->name("api.introletter.index");
Route::delete("/introletter/{introletter}/delete", [IntroletterController::class, "delete"])->name("api.introletter.delete");

Route::post("/recovery/{member}/create", [RecoveryController::class, "store"])->name("recovery.create");
Route::get("/recovery/{member}/get", [RecoveryController::class, "get"])->name("api.recovery.get");

Route::get("/recovery/report", [ \App\Http\Controllers\RecoveryController::class, "createReport" ])->name("api.recovery.report");
Route::get("/recovery/monthly/report", [RecoveryController::class, "getMonthlyReport"])->name("api.recovery.monthly.report");

Route::post("/member/{member}/receipt/create", [ReceiptController::class, "store"])->name("api.member.receipt");
Route::put("/receipt/{receipt}/update", [ReceiptController::class, "edit"])->name("api.member.receipt.update");
Route::get("/receipts/get", [ReceiptController::class, "get"])->name("api.member.receipts");
Route::delete("/receipt/{receipt}/delete", [ReceiptController::class, "delete"])->name("api.member.receipt.delete");

Route::get("/receipt/{receipt}/download", [ReceiptController::class, "download"])->name("api.member.receipt.download");
Route::get("/member/{receipt}/mail", [ReceiptController::class, "mail"])->name("api.member.recovery.receipt.mailer");

Route::post("/members/save/google_drive", [GoogleServicesController::class, "save"])->name("api.member.save.google.drive");

Route::get("/payment-methods", [PaymentMethodController::class, "get"])->name("api.payment-methods.index");
Route::post("/payment-method/create", [PaymentMethodController::class, "store"])->name("api.payment-methods.create");
Route::delete("/payment-method/{paymentMethod}/delete", [PaymentMethodController::class, "destroy"])->name("api.payment-methods.delete");
// Route::put("/payment-method/{paymentMethod}")

Route::get("/single-member/{member:user_token}/get", function(Member $member, ApiResponse $apiResponse) {
    if(!($member && $member->exists())) {
        return $apiResponse->error(404, "No member found");
    }

    return $apiResponse->success("Member Found!", $member);
})->name("api.member.get");

Route::get("/complain-types", [ComplainTypeController::class, "index"])->name("api.complains.complain-types.index");
Route::post("/complain-type/create", [ComplainTypeController::class, "store"])->name("api.complains.complain-types.create");
Route::delete("/complain-type/{complainType}/delete", [ComplainTypeController::class, "destroy"])->name("api.complains.complain-types.delete");
Route::put("/complain-type/{complainType}/update", [ComplainTypeController::class, "update"])->name("api.complains.complain-types.update");

Route::get("/complain-type/{complainType}/questions", [ComplainQuestionController::class, "get"])->name("api.complains.complain-type.questions");
Route::post("/complain-type/{complainType}/question/create", [ComplainQuestionController::class, "store"])->name("api.complains.complain-type.questions.create");
Route::put("/complain-type/{complainQuestion}/question/update", [ComplainQuestionController::class, "update"])->name("api.complains.complain-type.questions.update");
Route::delete("/complain-type/{complainQuestion}/question/delete", [ComplainQuestionController::class, "destroy"])->name("api.complains.complain-type.questions.delete");

Route::get("/complains", [ComplainController::class, "index"])->name("api.complains");
Route::delete("/complain/{complain}/delete", [ComplainController::class, "destroy"])->name("api.complain.delete");

Route::get("/users", [\App\Http\Controllers\Api\UserController::class, "index"])->name("api.users");
Route::post("/user/create", [\App\Http\Controllers\Api\UserController::class, "store"])->name("api.user.store");
Route::put("/user/{user}/update", [\App\Http\Controllers\Api\UserController::class, "update"])->name("api.user.update");
Route::delete("/user/{user}/delete", [\App\Http\Controllers\Api\UserController::class, "delete"])->name("api.user.delete");
Route::get("/user/priveleges", [\App\Http\Controllers\Api\UserController::class, "privileges"])->name("api.user.privileges");
Route::get("/check-token", [TokenController::class, "check"])->name("api.token.check");

Route::get("/user", [TokenController::class, "check_token"])->name("api.token.check-user");

Route::get("/otp/{user:username}/create", [\App\Http\Controllers\Api\Auth\AuthController::class, "otp"])->name("api.otp");
Route::get("/otp/{user:username}/check", [\App\Http\Controllers\Api\Auth\AuthController::class, "verifyOtp"])->name("api.otp.verify");
Route::post("/login", [\App\Http\Controllers\Api\Auth\AuthController::class, "login"])->name("api.login");
Route::post("/logout", [\App\Http\Controllers\Api\Auth\AuthController::class, "logout"])->name("api.logout");

Route::get("/{membership}/get", [MembershipController::class, "getByMembershipName"])->name("api.membership.get");


Route::get("/member/{member}/sheet", [FamilySheetController::class, "get"])->name("download.family-sheet");

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
