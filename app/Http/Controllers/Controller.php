<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function responseServer(int $statusCode = 200, array $data = []) {
        return response()->json($data, $statusCode, [] , JSON_PRETTY_PRINT);
    }
}
