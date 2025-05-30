<?php

namespace App;

class ApiResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function success($message, $data = []) {
        return response()->json([ "status" => "200", "message" => $message, "data" => $data ]);
    }
    public function error($code, $message) {
        return response()->json(["status" => $code, "message" => $message], $code);
    }
    public function forbidden($message = "This actions is forbidden!") {
        return $this->error(403, $message);
    }
}
