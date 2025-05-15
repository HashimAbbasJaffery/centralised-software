<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use Illuminate\Http\Request;

class CardTypeController extends Controller
{
    public function create() {
        return view("CardType.create");
    }
    public function index() {
        return view("CardType.index");
    }
    public function update(CardType $cardType) {
        return view("CardType.update", compact("cardType"));
    }
}
