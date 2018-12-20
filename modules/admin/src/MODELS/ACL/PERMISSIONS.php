<?php

namespace ARJUN\ADMIN\MODELS\ACL;

use Illuminate\Database\Eloquent\Model;

class PERMISSIONS extends Model {

    protected $table = 'permissions';

    public function roles() {
        return $this->belongsToMany(ROLES::class);
    }

    public function role() {
        return $this->belongsTo(ROLES::class);
    }

    public function permissionrole() {
        return $this->belongsTo(PERMISSIONROLE::class);
    }

}
