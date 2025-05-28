<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplainQuestionResource;
use App\Models\ComplainQuestion;
use App\Models\ComplainType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainQuestionController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function get(ComplainType $complainType) {
        return ComplainQuestionResource::collection($complainType->questions()->paginate(8));
    }

    public function store(ComplainType $complainType) {
        $rules = [
            "question" => [ "required" ],
            "is_relevant" => [ "required", "boolean" ]
        ];
        if((int)request()->is_relevant === 0) {
            $rules["answer"] = [ "required" ];
        }

        $validator = Validator::make(request()->all(), $rules);

        if($validator->fails()) {
            return $validator->getMessageBag();
        }

        $complainType->questions()->create($validator->validated());

        return $this->apiResponse->success("Complain Type's questions is created");
    }
    public function update(ComplainQuestion $complainQuestion) {
        $rules = [
            "question" => [ "required" ],
            "is_relevant" => [ "required", "boolean" ]
        ];

        if((int)request()->is_relevant === 0) {
            $rules["answer"] = [ "required" ];
        }

        $validator = Validator::make(request()->all(), $rules);
        
        if($validator->fails()) {
            return $validator->getMessageBag();
        }

        $complainQuestion->update($validator->validated());

        return $this->apiResponse->success("Complain's Question has been updated", $complainQuestion->complainType->id);
    }
    public function destroy(ComplainQuestion $complainQuestion) {
        if(!$complainQuestion->exists()) throw new ModelNotFoundException("No Complain Question found!");

        $complainQuestion->delete();

        return $this->apiResponse->success("Complain Question has been deleted!");
    }
}
