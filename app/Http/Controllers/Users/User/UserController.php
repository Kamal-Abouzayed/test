<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('userAuth:web');
    }

    public function index()
    {
        return \view('user');
    }






}
