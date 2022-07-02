<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repositories\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->middleware('auth:admin');

        $this->adminRepository = $adminRepository;

    }

    public function index()
    {
        $admins = $this->adminRepository->all();

        return \view('admins.admin', \compact('admins'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return \view('admins.create', \compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|min:8',
            'roles' => 'required'
        ]);

        // \dd($request->password);
        $this->adminRepository->create($request->all());
        $this->adminRepository->assignRole($request->input('roles'));

        return \redirect(\route('admin.dashboard'));
    }

    public function edit($id)
    {
        $admin = $this->adminRepository->get($id);
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();

        return \view('admins.edit', \compact('admin', 'roles', 'adminRole'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'sometimes|required|min:8',
            'roles' => 'required'
        ]);

        $this->adminRepository->update($id ,$request->all());

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $this->adminRepository->assignRole($request->input('roles'));

        return \redirect(\route('admin.dashboard'));
    }

    public function destroy($id)
    {
        $this->adminRepository->delete($id);

        return \redirect(\route('admin.dashboard'));
    }




}
