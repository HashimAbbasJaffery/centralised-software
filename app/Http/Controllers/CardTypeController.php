<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardTypeController extends Controller
{
    public function create() {
        return view("CardType.create");
    }
}
