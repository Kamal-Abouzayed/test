<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function showLoginForm()
    {
        return \view('auth.user-login');
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password ], $request->remember)) {
            return \redirect()->intended(\route('home'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
