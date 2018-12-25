<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ARJUN\ADMIN\MODELS\ACL\DEFAULTROLE;
use ARJUN\ADMIN\MODELS\ACL\ROLEUSERS;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONROLE;

class User extends Authenticatable {

    use Notifiable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function myrole() {
        return $this->hasOne(DEFAULTROLE::class, 'user_id');
    }

    public function myroles() {
        return $this->hasMany(ROLEUSERS::class);
    }

    public function mymenus() {
        return $this->hasMany(PERMISSIONROLE::class);
    }

    public function getNameAttribute($value) {
        return ucfirst($value);
    }

}
