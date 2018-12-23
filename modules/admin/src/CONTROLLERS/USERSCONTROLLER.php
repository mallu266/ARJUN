<?php

namespace ARJUN\ADMIN\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Auth;
use ARJUN\ADMIN\MODELS\USERS;
use ARJUN\ADMIN\MODELS\ACL\ROLES;
use Illuminate\Support\Facades\Validator;

class USERSCONTROLLER extends Controller {

    protected $package;
    protected $primaryKey = 'id';

    public function __construct() {
        $this->package = 'admin';
        // $this->ftpbase = Storage::disk('ftp');
    }

    public function index() {
        $data['users'] = USERS::all();

        return view($this->package . '::users/index')->with($data);
    }

    public function action($id = false) {
        $data['action'] = request()->segment(3);
        $users = array();
        if ($id) {
            $users = USERS::where('id', $id)->first();
        }
        $data['users'] = $users;
        $data['roles'] = ROLES::all();
        return view($this->package . '::users/action')->with($data);
    }

    public function addupdate($id = false) {
        $requests = request()->all();
        if ($id == false) {
            $rules['email'] = 'required|unique:users';
        }
        $rules['name'] = 'required';
        $rules['roles'] = 'required';
        $rules['password'] = 'required';
        $validator = Validator::make($requests, $rules);
        if ($validator->fails()) {
            return back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $user = new USERS();
        if ($id) {
            $user = USERS::findOrFail($id);
        }
        $skipfields = array('roles', '_token', 'conf_password');
        foreach ($requests as $key => $value) {
            if (!in_array($key, $skipfields)) {
                $user->$key = $value;
            }
        }
        $user->defaultRole(1);
        $user->save();
        $user->assignRoles(request()->get('roles'));

        return back();
    }

}
