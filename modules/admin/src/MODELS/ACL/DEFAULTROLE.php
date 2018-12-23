<?php

namespace ARJUN\ADMIN\MODELS\ACL;

use Illuminate\Database\Eloquent\Model;

class DEFAULTROLE extends Model {
    

    protected $table = 'default_role';

    public function user() {
        return $this->belongsTo('App\User');
    }

}
