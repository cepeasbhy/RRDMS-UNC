<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'staff_id',
        'archive_id'
    ];
}
