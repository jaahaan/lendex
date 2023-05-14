<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','userType','username','contact','user_role_id'
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


   
    public function role(){
       return $this->belongsTo('App\Models\UserRole', 'user_role_id');
    }
}
