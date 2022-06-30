<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\options;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Hook;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index.index');
    }
    public function get_layout_setting()
    {
        $layout_setting_data = options::select('name', 'value')->get()->toArray();
        echo json_encode($layout_setting_data);
    }
    public function set_layout_setting(Request $request)
    {
        options::where('name', $request['name'])->update(['value' => $request['value']]);
        echo json_encode(['success' => 'true']);
    }
    public function reset_layout_setting()
    {
        options::where('name', 'headerBackground')->update(['value' =>'']);
        options::where('name', 'navigationBackground')->update(['value' =>'']);
        options::where('name', 'menuDropdownIcon')->update(['value' =>'icon-style-3']);
        options::where('name', 'menuListIcon')->update(['value' =>'icon-list-style-4']);
        echo json_encode(['success' => 'true']);
    }
}
