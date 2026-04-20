<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(
        mixed $data = null,
        string $message = 'Success',
        int $code = 200
    ): JsonResponse {
        return response()->json([
            'code'    => $code,
            'data'    => $data,
            'error'   => '',
            'message' => $message,
        ], $code);
    }

    public static function error(
        string $message = 'Error',
        mixed $error = null,
        int $code = 400
    ): JsonResponse {
        return response()->json([
            'code'    => $code,
            'data'    => null,
            'error'   => $error,
            'message' => $message,
        ], $code);
    }

    public static function paginate(
        $paginator,
        mixed $items,
        string $message = 'Success'
    ): JsonResponse {
        return response()->json([
            'code' => 200,
            'data' => [
                'data'              => $items,
                'halaman_sekarang'  => $paginator->currentPage(),
                'per_halaman'       => $paginator->perPage(),
                'total_data'        => $paginator->total(),
                'total_halaman'     => $paginator->lastPage(),
            ],
            'error'   => '',
            'message' => $message,
        ]);
    }
}
