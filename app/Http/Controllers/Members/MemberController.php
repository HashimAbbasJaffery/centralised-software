<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        return view("Members.index");
    }
    public function create() {
        return view("Members.create");
    }
}
