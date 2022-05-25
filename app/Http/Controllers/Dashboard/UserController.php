<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        $title = trans('site.users');
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);
        return view('dashboard.users.index', compact('title', 'users'));
    }


    public function create()
    {
        $title = trans('site.users');
        return view('dashboard.users.create', compact('title'));
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->except(['password', 'password_confirmation', 'permissions']);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', trans('data_added_successfully'));
        return redirect()->route('dashboard.users.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $title = trans('site.users');
        return view('dashboard.users.edit', compact('title', 'user'));
    }


    public function update(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
//            'email' => 'required|email|unique:users,email,'.$user->id,
            'email' => ['required',Rule::unique('users')->ignore($user->id)],
            'permissions' => 'required|min:1'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->except(['permissions']);

        $user->update($data);
        $user->syncPermissions($request->permissions);

        session()->flash('success', trans('data_updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('warning', trans('data_deleted_successfully'));
        return redirect()->back();
    }
}
