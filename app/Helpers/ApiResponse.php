<?php

namespace App\Helpers;


class ApiResponse
{
    static function success($data = null)
    {
        $response = [
            'success' => true,
            'message' => 'success',
            'data'    => $data
        ];

        return response()->json($response, 200);
    }

    static function fail($code, $error = null)
    {
        $response = [
            'success' => false,
            'message' => 'Whoops, looks like something went wrong',
        ];

        switch ($code) {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = $error;
            default:
                $response['error'] = $error;
                break;
        }
        return response()->json($response, 200);
    }
}
