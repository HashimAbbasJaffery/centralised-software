<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardTypeRequest;
use App\Models\CardType;
use Illuminate\Http\Request;

class CardTypeController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function store(CardTypeRequest $request) {
        $card_type = CardType::create($request->validated());

        return $this->apiResponse->success("Card Type is created");
    }
}
