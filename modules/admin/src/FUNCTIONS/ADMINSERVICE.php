<?php

namespace ARJUN\ADMIN\FUNCTIONS;

use ARJUN\ADMIN\MODELS\ACL\ROLES;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONS;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONROLE;

class ADMINSERVICE {

    public static function mypermissions($role_id) {
        return PERMISSIONROLE::select('permission_id')->where('role_id', $role_id)->get();
    }

    public static function permission($id) {
        return PERMISSIONS::select('slug', 'name')->where('id', $id)->first();
    }

    public static function getrole($id) {
        return ROLES::where('id', $id)->first();
    }

}
