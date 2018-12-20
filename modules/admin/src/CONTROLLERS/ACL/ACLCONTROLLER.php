<?php

namespace ARJUN\ADMIN\CONTROLLERS\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use ARJUN\ADMIN\MODELS\ACL\ROLES;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONS;
use ARJUN\ADMIN\MODELS\ACL\PERMISSIONROLE;
use App\User;

class ACLCONTROLLER extends Controller {

    protected $package;

    public function __construct() {
        $this->package = 'admin';
        // $this->ftpbase = Storage::disk('ftp');
    }

    public function index() {
        return view($this->package . '::acl/index');
    }

    public function rolematrix() {
        $data['roles'] = ROLES::all();
        $data['permissions'] = PERMISSIONS::all();
        return view($this->package . '::acl/rolematrix')->with($data);
    }

    public function usermatrix() {
        $data['users'] = User::all();
        $data['roles'] = ROLES::all();
        $data['permissions'] = PERMISSIONS::all();
        return view($this->package . '::acl/usermatrix')->with($data);
    }


    public function postrolematrix(Request $request) {
        $permission_role = $request->get('permission_role');
        foreach ($permission_role as $rp) {
            $data[] = array(
                'role_id' => $rp[0],
                'permission_id' => $rp[2],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        }
        PERMISSIONROLE::truncate();
        PERMISSIONROLE::insert($data);
        if (1) {
            $sweetalert['status'] = 'success';
            return back()->with($sweetalert);
        }
    }

    public static function permissionrole($role_id, $permission_id) {
        $permission = PERMISSIONROLE::select('permission_id')
                ->where('role_id', $role_id)
                ->where('permission_id', $permission_id)
                ->first();
        return $permission;
    }

}
