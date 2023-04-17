<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'subtitle',
        'howToComplete',
        'ideaGenerate',
        'reasearchSketching',
        'launcedProject',
        'ResultSummery',
        'description',
        'projectName',
        'clients',
        'budget',
        'duration',
        'date',
    ];
}
