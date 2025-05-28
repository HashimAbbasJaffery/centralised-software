<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function get() {
        return view("Complains.index");
    }
    public function getOne(Complain $complain) {
        $member = $complain->member;
        $complain->load(["complainQuestion.complainType"]);

        return view("Complains.complain_detail", compact("complain", "member"));
    }
}
