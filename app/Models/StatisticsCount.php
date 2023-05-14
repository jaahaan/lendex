<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticsCount extends Model
{
    use HasFactory;
    protected $fillable = [
        'happyClients',
        'projectComplete',
        'yearsOfExperience',
    ];
}
