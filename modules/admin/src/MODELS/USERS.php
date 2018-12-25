<?php

namespace ARJUN\ADMIN\MODELS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use ARJUN\ADMIN\MODELS\ACL\ROLEUSERS;
use ARJUN\ADMIN\MODELS\ACL\DEFAULTROLE;

class USERS extends Model {

    use Notifiable;

    protected $table = 'users';

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

    public function hasroleids($id) {
        $roleids = ROLEUSERS::where('user_id', $id)->pluck('role_id');

        return $roleids;
    }

    public function roles() {
        return $this->belongsToMany(ROLEUSERS::class, 'role_users', 'user_id', 'role_id');
    }

    public function role() {
        return $this->belongsTo(DEFAULTROLE::class, 'default_role', 'user_id', 'role_id');
    }

    public function assignRoles($roles) {
        $this->roles()->sync($roles);
    }

    public function defaultRole($role) {
        $user_id = auth()->user()->id;
        $defaultrole = DEFAULTROLE::where('user_id', $user_id)->first();
        if (empty($defaultrole)) {
            $defaultrole = new DEFAULTROLE();
        }
        $defaultrole->user_id = $user_id;
        $defaultrole->role_id = $role;
        $defaultrole->save();
    }

    public function setPasswordAttribute($pass) {
        $this->attributes['password'] = bcrypt($pass);
    }

}
