<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'description',
        'projectName',
        'clients',
        'budget',
        'duration',
        'date',
    ];
}
