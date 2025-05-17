<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $guarded = ['id'];

    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }

    public function reportStatus()
    {
        return $this->belongsTo(ReportStatus::class);
    }
}
