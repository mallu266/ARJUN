<?php

namespace ARJUN\ADMIN\MODELS\ACL;

use Illuminate\Database\Eloquent\Model;

class ROLES extends Model {

    protected $table = 'roles';

    public function permissions() {
        return $this->hasMany(PERMISSIONS::class);
    }

}
