<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    protected $fillable=['name','authorize_routes'];

    protected $casts = [
        'authorize_routes' => 'array',
    ];
}
