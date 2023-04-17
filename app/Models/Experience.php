<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company',
        'designation',
        'start_date',
        'end_date',
        'description',
    ];
}
