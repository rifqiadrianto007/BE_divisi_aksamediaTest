<?php

namespace App\Helpers;

class ApiResponse
{

    public static function success($message, $data = null, $pagination = null)
    {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if ($pagination !== null) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response);
    }

    public static function error($message, $code = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }

}
