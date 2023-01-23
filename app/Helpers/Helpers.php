<?php

namespace App\Helpers;

class Helpers
{
    public static function SuccessResponse(array $data): object
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
