<?php

namespace ARJUN\ADMIN\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use ARJUN\ADMIN\MODELS\USERS;
use ARJUN\ADMIN\MODELS\ACL\ROLES;
use ARJUN\ADMIN\NOTIFICATIONS\USERREGISTRATION;
use ARJUN\ADMIN\MODELS\SETPASSWORD;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
        $when = now()->addSeconds(5);
        $requests = request()->all();
        if ($id == false) {
            $rules['email'] = 'required|unique:users';
        }
        $rules['name'] = 'required';
        $rules['roles'] = 'required';
        $validator = Validator::make($requests, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
        $token = $this->setusertoken($user->email);
        $user->notify((new USERREGISTRATION($user, $password, $token))->delay($when));
        $notification['status'] = 'success';
        return back()->with($notification);
    }

    public function setusertoken($email) {
        $token = $this->generateRandomString(30);
        $setpassword = new SETPASSWORD();
        $setpassword->email = $email;
        $setpassword->token = $token;
        $setpassword->save();
        return $token;
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

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function setpassword($email, $token) {
        $data['email'] = base64_decode($email);
        $data['token'] = $token;
        return view($this->package . '::password.setpassword')->with($data);
    }

    public function PostSetPassword(Request $request) {
        $rules['email'] = 'required|email';
        $rules['password_confirmation'] = 'required';
        $rules['password'] = 'required|min:6|confirmed';
        $rules['oldpassword'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $email = $request->email;
        $password = $request->password;
        $oldpassword = $request->oldpassword;
        $token = $request->token;
        $setpwd = SETPASSWORD::where('email', $email)->where('token', $token)->first();
        if ($setpwd) {
            $users = USERS::where("email", $email)->first();
            if (Hash::check($oldpassword, $users->password)) {
                $users->password = bcrypt($password);
                if ($users->save()) {
                    SETPASSWORD::where('email', $email)->where('token', $token)->delete();
                }
                Auth::guard('web')->login($users);
                return back();
            } else {
                echo "Old pwd not matching"; exit;
                return back();
            }
        } else {
            echo "Out"; exit;
            return back();
        }
    }

    public function testnotification() {
        $when = now()->addSeconds(5);
        $user = USERS::findOrFail(5);
        $user->notify((new USERREGISTRATION($user))->delay($when));
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
