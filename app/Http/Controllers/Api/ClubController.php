<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClubRequest;
use App\Http\Resources\ClubResource;
use App\Models\Club;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClubController extends Controller
{

    public function __construct(protected ApiResponse $apiResponse) {}
    public function store(ClubRequest $request) {
        $club = Club::create($request->validated());

        return $this->apiResponse->success("Club has been created");
    }
    public function index() {
        $keyword = request()->keyword;
        $clubs = Club::whereLike("club_name", "%$keyword%")
                        ->orWhereLike("country" , "%$keyword%")
                        ->orWhereLike("city", "%$keyword%")
                        ->paginate(8);

        return ClubResource::collection($clubs);
    }
    public function delete(Club $club) {
        if(!$club->exists()) throw new ModelNotFoundException("Club not found!");

        $club->delete();

        return $this->apiResponse->success("Club has been deleted");
    }
}
