<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_id',
        'point',
        'order_no',
    ];
  
    public function title(){
        return $this->belongsTo('App\Models\ServiceTitle', 'title_id');
    }
}
