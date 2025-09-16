<?php

namespace App\Http\Controllers;

use App\DataTables\MemberBirthdayDataTable;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index(MemberBirthdayDataTable $dataTable) {
        return $dataTable->render("Members.birthdays");
    }
}
