<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplainTypeResource;
use App\Models\ComplainType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainTypeController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {
        $this->middleware("auth:sanctum");
    }
    public function index() {

        $keyword = request()->keyword;
        $complainTypes = ComplainType::where("complain_type", "LIKE", "%$keyword%")->paginate(8);

        return ComplainTypeResource::collection($complainTypes);
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "complain_type" => [ "required" ]
        ]);

        if($validator->fails()) {
            return $this->apiResponse->error(422, "Complain Type is required!");
        }

        $complain_type = ComplainType::create($validator->validated());

        return $this->apiResponse->success("Complain Type has been inserted!", [ "id" => $complain_type->id ]);
    }
    public function update(ComplainType $complainType) {
        $validator = Validator::make(request()->all(), [
            "complain_type" => [ "required" ]
        ]);

        if($validator->fails()) {
            return $this->apiResponse->error(422, "Complain Type is required!");
        }

        $complain_type = $complainType->update($validator->validated());

        return $this->apiResponse->success("Complain Type has been inserted!");
    }
    public function destroy(ComplainType $complainType) {
        if(!$complainType->exists()) {
            throw new ModelNotFoundException("Payment Method not found!");
        }

        $complainType->delete();

        return $this->apiResponse->success("Complain Type has been deleted!");
    }
}
