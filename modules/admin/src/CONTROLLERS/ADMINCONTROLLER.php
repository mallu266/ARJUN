<?php

namespace ARJUN\ADMIN\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Auth;

class ADMINCONTROLLER extends Controller {

    protected $package;

    public function __construct() {
        $this->package = 'admin';
        // $this->ftpbase = Storage::disk('ftp');
    }

    public function login() {
        return redirect('admin/login');
    }

    public function index() {
        return view($this->package . '::index');
    }

    public function showDasbboard() {
        return view($this->package . '::dashboard');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function installpackage() {
        $id = request()->get('package');
        $package = Packages::find($id);
        $res = exec('cd .. && ' . $package->package);
        if ($res) {
            $response['status'] = 'success';
            $response['message'] = 'Package Installed successfully';
        } else {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong';
        }
        return $response;
    }

}
