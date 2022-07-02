<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function showRegisterForm()
    {
        return \view('auth.user-register');
    }

    public function Register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $request['password'] = Hash::make($request->password);

        User::create($request->all());

        return \redirect()->intended(\route('user.dashboard'));
    }
}
