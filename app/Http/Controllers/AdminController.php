<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\User;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function register()
    {
        return view('admin.register');
    }
    public function index()
    {
        return view('admin.index.index');
    }
    public function admin_registration(StoreUser $request)
    {
        $input = $request->all();
        $user = new User();
        $result = $user->store_user($input);
        return redirect()->route('admin.index');
    }
}
