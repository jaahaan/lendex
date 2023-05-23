<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'title',
        'order_no',
    ];
    public function points(){
        return $this->hasMany('App\Models\ServicePoint','title_id');
    }
}
