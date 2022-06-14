<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\options;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }
    public function get_layout_setting()
    {
        $layout_setting_data = options::select('name','value')->get()->toArray();
        echo json_encode($layout_setting_data);
        // return $layout_setting_data;
    }
}
