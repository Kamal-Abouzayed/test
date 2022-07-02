<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();

        // \dd($users);

        return \view('users.user', \compact('users'));
    }

    public function create()
    {
        return \view('users.create-user');
    }

    public function store(Request $request)
    {
        $user = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|min:8',
        ]);



        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        $user->save();


        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $image = \time().'-'.$file->getClientOriginalName();
                $image = str_replace(' ','-',$image);
                $file->move('images', $image);
                $user->image()->create(['images' => $image]);
            }

        }

        return \redirect(\route('user.index'))->with('success', 'user has been created successfully');


    }


    public function edit($id)
    {
        $user = User::find($id);

        $images = DB::table('images')->where('user_id' , $id)->get();

        // \dd($images);

        return \view('users.edit-user', \compact('user', 'images'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => 'sometimes|nullable|min:8'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->password);
        }

        if (!empty($request->images)) {
           $images = $request->input('images', []);
           Image::whereIn("id", $images)->delete();
        }

        $user->save();

        return \redirect('/admin');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();


        return \redirect(\route('user.index'));

    }
}
