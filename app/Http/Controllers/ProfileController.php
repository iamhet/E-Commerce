<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function redirect_user()
    {
        // dd(auth()->user());
        if(auth()->user()->hasRole('admin')){
            return redirect('admin/dashboard');
        }
        if(auth()->user()->hasRole('client')){
            return redirect()->route('client.dashboard');
        }
    }
}
