<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePlaning extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'type',
        'price',
        'facilities',
    ];
    public function service()
    {
       return $this->belongsTo('App\Models\Service','service_id','id');
    }

}
