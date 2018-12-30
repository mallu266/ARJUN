<?php

namespace ARJUN\ADMIN\CONTROLLERS\AUTH;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class LOGINCONTROLLER extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    public function __construct() {
        $this->package = 'admin';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm() {
        return view($this->package . '::auth.login');
    }

    public function login() {
        $email = request()->get('email');
        $password = request()->get('password');
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/dashboard');
        }
    }

    protected function guard() {
        return Auth::guard('admin');
    }

    public function screenlock() {
        session()->put('screenlock', true);
    }

    public function screenunlock(Request $request) {
        $check = Hash::check($request->input('password'), $request->user()->password);
        if ($check) {
            session()->put('screenlock', false);
            return 'true';
        }
        return 'false';
    }

}
