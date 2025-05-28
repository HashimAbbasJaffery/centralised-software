<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Models\ComplainQuestion;
use App\Models\ComplainType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainQuestionController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function index(ComplainType $complainType) {
        return view("Complains.Complain Types.ComplainQuestions.index", compact("complainType"));
    }

    public function create(ComplainType $complainType) {
        return view("Complains.Complain Types.ComplainQuestions.create");
    }

    public function update(ComplainQuestion $complainQuestion) {
        return view("Complains.Complain Types.ComplainQuestions.update", compact("complainQuestion"));
    }

}
