<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    //
    protected $fillable =['parent_id','type','title','name','path','icon','is_show','order_no'];


    public function menus(){
        return $this->hasMany(Router::class,'parent_id')->orderby('order_no','asc');
    }
}
