<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','userType','username','contact','store_id','employee_id','national_id','passport_no','user_role_id'
    ];
    public function setPasswordAttribute($password){
        if ( $password !== null ) {
            if ( is_null(request()->bcrypt) ) {
                $this->attributes['password'] = bcrypt($password);
            } else {
                $this->attributes['password'] = $password;
            }
        }
    }

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function customer(){
       return $this->belongsTo('App\Models\Customer', 'id', 'userId');
    }
    public function wishlist(){
        return $this->belongsTo('App\Models\Wishlist', 'id','userId');
    }
    public function store(){
       return $this->belongsTo('App\Models\Store', 'store_id');
    }
    public function role(){
       return $this->belongsTo('App\Models\UserRole', 'user_role_id');
    }
}
