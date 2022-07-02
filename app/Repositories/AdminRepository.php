<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface
{
    public function all()
    {
        return Admin::all();
    }

    public function get($id)
    {
        return Admin::find($id);
    }

    public function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function update($id, array $data)
    {
        return Admin::find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function delete($id)
    {
        return Admin::destroy($id);
    }
}
