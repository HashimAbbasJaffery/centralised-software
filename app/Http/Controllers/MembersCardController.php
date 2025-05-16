<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersCardController extends Controller
{
    public function index() {
        $members = Member::whereIn("id", request()->members)->get();
        return view("Cards.front", compact("members"));
    }
    public function back() {
        $members = Member::whereIn("id", request()->members)
                            ->get()
                            ->chunk(2)
                            ->map(fn($chunk) => $chunk->reverse())
                            ->flatten();
                            
        return view("Cards.back", compact("members"));
    }
}
