<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Models\options;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    public function save_general_settings(Request $request)
    {
        // dd($request);
        if($request->dark_logo)
        {
            unlink('logo/'.get_option('dark_logo'));
            $dark_logo = $request->dark_logo;
            $dark_logo_name = 'dark_logo.'.$dark_logo->getClientOriginalExtension();
            $request->dark_logo->move('logo',$dark_logo_name);
            $request->dark_logo = $dark_logo_name;
        }
        if($request->light_logo)
        {
            unlink('logo/'.get_option('light_logo'));
            $light_logo = $request->light_logo;
            $light_logo_name = 'light_logo.'.$light_logo->getClientOriginalExtension();
            $request->light_logo->move('logo',$light_logo_name);
            $request->light_logo = $light_logo_name;
        }
       

        if($request->favicon)
        {
            unlink('logo/'.get_option('favicon'));
            $favicon = $request->favicon;
            $favicon_name = 'favicon.'.$favicon->getClientOriginalExtension();
            $request->favicon->move('logo',$favicon_name);
            $request->favicon = $favicon_name;
        }

        foreach ($request->all() as $key => $value) {
            if($key != '_token')
            {
                if(!empty($value))
                {
                    if($key == 'light_logo')
                    {
                        $value = $light_logo_name;
                        
                    }
                    if($key == 'dark_logo')
                    {
                        $value = $dark_logo_name;
                    }
                    if($key == 'favicon')
                    {
                        $value = $favicon_name;
                    }
                    set_option($key,$value);
                }
            }
        }
        return Redirect::back()->with('success','Item created successfully!');
    }
}
