<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    protected $table = 'report_statuses';

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
}
