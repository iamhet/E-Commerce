<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\options;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    }
    public function set_layout_setting(Request $request)
    {
        options::where('name',$request['name'])->update(['value'=>$request['value']]);
        echo json_encode(['success' => 'true']);
    }
    public function settings()
    {
        return view('admin.settings.settings');
    }
    public function save_settings(Request $request)
    {
        
    }
}
