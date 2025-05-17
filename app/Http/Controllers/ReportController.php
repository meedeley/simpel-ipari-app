<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{

    public function findAllReports()
    {
        $reports = \App\Models\Report::query()
            ->select(['id', 'title', 'slug', 'excerpt', 'content', 'category_id', 'user_id'])
            ->with(['category' => function ($query) {
                $query->select(['id', 'name', 'slug']);
            }])
            ->with(['user' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->get();

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $reports
        ]);
    }

    public function findReportBySlug($slug)
    {
        $report = \App\Models\Report::query()
            ->select(['id', 'title', 'slug', 'excerpt', 'content', 'category_id', 'user_id'])
            ->with(['category' => function ($query) {
                $query->select(['id', 'name', 'slug']);
            }])
            ->with(['user' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->where('slug', $slug)
            ->first();

        if (!$report) {
            return $this->responseServer(404, ['message' => 'Report not found']);
        }

        return $this->responseServer(200, [
            "statusCode" => 200,
            "data" => $report
        ]);
    }

    public function storeReport(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'report_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_number' => 'nullable|string|max:15',
            'report_type_id' => 'required|exists:report_types,id',
            'report_status_id' => 'required|exists:report_statuses,id',
            'guest_id' => 'required|exists:guests,id',
        ]);

        if ($validated->fails()) {
            return $this->responseServer(422, [
                "statusCode" => 422,
                "message" => $validated->errors()
            ]);
        }

        $report = Report::create([
            'report_date' => $request->input('report_date'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'contact_number' => $request->input('contact_number'),
            'report_type_id' => $request->input('report_type_id'),
            'report_status_id' => $request->input('report_status_id'),
            'guest_id' => $request->input('guest_id'),
        ]);

        return $this->responseServer(201, [
            "statusCode" => 201,
            "data" => $report
        ]);
    }
}
