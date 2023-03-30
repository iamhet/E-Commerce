<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $userLogin = 1;
            return view('client.index.index')->with('userLogin',$userLogin);
        } else {
            return view('client.index.index');
        }
    }
    public function clientLogin()
    {
        return view('client.clientLogin');
    }
    public function clientRegistration()
    {
        return view('client.clientRegistration');
    }
    public function clientRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $role = Role::findByName('client');

        $role->users()->attach($user);
        // $user->assignRole('client');
        return redirect()->route('client.clientLogin');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
