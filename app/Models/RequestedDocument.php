<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'diploma',
        'transcript_of_record',
        'certificate',
        'copy_of_grades',
        'authentication',
        'photocopy',
        'total_fee',
    ];

    protected $casts = [
        'diploma' => 'json',
        'transcript_of_record' => 'json',
        'certificate' => 'json',
        'copy_of_grades' => 'json',
        'authentication' => 'json',
        'photocopy' => 'json',
    ];
}
