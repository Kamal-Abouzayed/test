<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return \view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //validate form data

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        //attempt to log admin
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return \redirect()->intended(\route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));

    }
}
