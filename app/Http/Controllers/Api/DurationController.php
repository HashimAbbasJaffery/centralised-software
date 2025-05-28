<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DurationResource;
use App\Models\Duration;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {
        $this->middleware("auth:sanctum");
    }
    public function index() {
        $keyword = request()->keyword;
        $duration = Duration::whereLike("months", "%$keyword%")
                                ->orWhereLike("fee", "%$keyword%")->paginate(8);

        return DurationResource::collection($duration);
    }
    public function delete(Duration $duration) {
        if(!$duration->exists()) throw new ModelNotFoundException("Duration doesn't exist");

        $duration->delete();

        return $this->apiResponse->success("Duration has been deleted!");
    }
    public function store() {
        $duration = Duration::create([
            "months" => request()->months,
            "fee" => request()->fee
        ]);

        return $this->apiResponse->success("Duration has been created!");
    }
    public function update(Duration $duration) {
        if(!$duration->exists()) throw new ModelNotFoundException("Duration not found!");

        $duration->update([
            "months" => request()->months,
            "fee" => request()->fee
        ]);

        return $this->apiResponse->success("Duration has been updated");
    }
}
