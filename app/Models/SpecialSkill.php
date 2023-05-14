<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'percentage',
        'order_no',
    ];
}
