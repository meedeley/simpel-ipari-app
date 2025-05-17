<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class GetTokenController extends Controller
{
    public function getToken(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                'statusCode' => 401,
                'message'    => 'Token tidak disertakan'
            ], 401);
        }

        try {
            $payload = JWTAuth::parseToken()->getPayload();

            $user = JWTAuth::parseToken()->authenticate();

            return response()->json([
                'statusCode' => 200,
                'payload'    => $payload,
                'user'       => $user
            ]);
        }
        catch (JWTException $e) {
            return response()->json([
                'statusCode' => 401,
                'message'    => 'Token tidak valid atau kedaluwarsa',
                'error'      => $e->getMessage()
            ], 401);
        }
    }
}
