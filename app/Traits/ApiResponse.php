<?php

namespace App\Traits;

trait ApiResponse
{

    public function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($data, $message = null, $code = 500)
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
