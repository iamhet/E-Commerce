<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index.index');
    }
    public function clientLogin()
    {
        return view('client.clientLogin');
    }
    public function clientsignin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function clientRegistration()
    {
        return view('client.clientRegistration');
    }


    public function clientsignup(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phonenumber' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->clientCreate($data);

        return redirect("/")->withSuccess('You have signed-in');
    }


    public function clientCreate(array $data)
    {
        return Client::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'address' => $data['address'],
            'phonenumber' => $data['phonenumber'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
