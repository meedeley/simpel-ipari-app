<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportTypeController extends Controller
{
    public function findAllReportTypes()
    {
        $reportTypes = \App\Models\ReportType::all();

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $reportTypes
        ]);
    }
}
