<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplainResource;
use App\Models\Complain;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function index() {
        $complains = Complain::paginate(8);

        return ComplainResource::collection($complains);
    }
    public function destroy(Complain $complain) {
        if(!$complain->exists()) throw new ModelNotFoundException("Complain not found!");

        $complain->delete();

        return $this->apiResponse->success("Complain deleted!");
    }
}
