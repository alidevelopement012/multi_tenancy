<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploader extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'filepath',
        'mimetype',
        'size',
        'user_id',
        'assign_to',
    ];
}
