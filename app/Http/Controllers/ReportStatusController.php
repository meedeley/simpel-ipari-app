<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportStatusController extends Controller
{
    public function findAllReportStatuses()
    {
        $reportStatuses = \App\Models\ReportStatus::all();

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $reportStatuses
        ]);
    }
}
