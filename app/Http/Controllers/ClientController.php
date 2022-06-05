<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function load_home()
    {
        return view('client.index.index');
    }
    public function load_product()
    {
        return view('client.product.index');
    }
    public function load_blog()
    {
        return view('client.blog.index');
    }
    public function load_contact()
    {
        return view('client.contact.index');
    }
}
