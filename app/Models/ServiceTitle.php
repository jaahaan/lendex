<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'icon',
        'title',
        'order_no',
    ];
}
