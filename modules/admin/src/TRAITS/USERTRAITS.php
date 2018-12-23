<?php

namespace ARJUN\ADMIN\TRAITS; // *** Adjust this to match your model namespace! ***

use Illuminate\Database\Eloquent\Builder;
use ARJUN\ADMIN\MODELS\ACL\ROLEUSERS;
use ARJUN\ADMIN\MODELS\ACL\DEFAULTROLE;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONROLE;

trait USERTRAITS
{
    public function myrole()
    {
        return $this->hasOne(DEFAULTROLE::class);
    }

    public function myroles()
    {
        return $this->hasMany(ROLEUSERS::class);
    }

    public function mymenus()
    {
        return $this->hasMany(PERMISSIONROLE::class);
    }
    public function roles()
    {
        return $this->belongsToMany(ROLEUSERS::class, 'role_users', 'user_id', 'role_id');
    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }
}
