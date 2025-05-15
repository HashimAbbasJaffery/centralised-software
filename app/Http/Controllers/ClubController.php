<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index() {
        return view("Clubs.index");
    }
    public function create() {
        return view("Clubs.create");
    }
    public function update(Club $club) {
        return view("Clubs.update", compact("club"));
    }
}
