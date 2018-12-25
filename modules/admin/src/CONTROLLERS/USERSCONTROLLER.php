<?php

namespace ARJUN\ADMIN\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Auth;
use ARJUN\ADMIN\MODELS\USERS;
use ARJUN\ADMIN\MODELS\ACL\ROLES;
use ARJUN\ADMIN\NOTIFICATIONS\USERREGISTRATION;
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
        $when = now()->addMinutes(5);
        $requests = request()->all();
        if ($id == false) {
            $rules['email'] = 'required|unique:users';
        }
        $rules['name'] = 'required';
        $rules['roles'] = 'required';
        $validator = Validator::make($requests, $rules);
        if ($validator->fails()) {
            return back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $password = $this->randompassword(6);
        $user = new USERS();
        if ($id) {
            $user = USERS::findOrFail($id);
        }
        $skipfields = array('roles', '_token');
        foreach ($requests as $key => $value) {
            if (!in_array($key, $skipfields)) {
                $user->$key = $value;
            }
        }
        $user->password = bcrypt($password);
        $user->save();
        $user->assignRoles(request()->get('roles'));
        $user->notify((new USERREGISTRATION($user))->delay($when));
        $notification['status'] = 'success';
        return back()->with($notification);
    }

    public function randompassword($length = 6) {
        $str = "";
        $symbol = '$#';
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str . str_shuffle($symbol);
    }

    public function testnotification() {
        $when = now()->addSeconds(5);
        $user = USERS::findOrFail(5);
//        $user->notify((new USERREGISTRATION($user))->delay($when));
        foreach ($user->notifications as $notification) {
            echo '<br>' . $notification->type;
        }
//        foreach ($user->unreadNotifications as $notification) {
//            echo '<br>' . $notification->type;
//        }
//        foreach ($user->unreadNotifications as $notification) {
//            $notification->markAsRead();
//        }
//        $user->notifications()->delete();
    }

}
