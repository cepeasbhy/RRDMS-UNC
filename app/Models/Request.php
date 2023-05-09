<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'student_id',
        'course_id',
        'department_id',
        'release_date',
        'date_completed',
        'status',
        'submitted_file_loc',
        'reason_for_rejection'
    ];

    protected $casts = [
        'submitted_file_loc' => 'json',
    ];
}
