<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PermissionDatatable;
use App\DataTables\ProductCategoryDatatable;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Models\options;
use App\Models\product_categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Hook;
use App\DataTables\RoleDatatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    public function settings()
    {
        global $hooks;
        $hooks->do_action('after_settings');

        return view('admin.settings.settings');
    }
    public function company_information()
    {

        return view('admin.settings.company_information');
    }
    public function email()
    {

        return view('admin.settings.email');
    }
    public function product_category(ProductCategoryDatatable $datatable)
    {
        return $datatable->render('admin.settings.product_category');
    }
    public function save_product_category(Request $request)
    {
        if (!empty($request->categoryId)) {
            $product_categories = product_categories::find($request->categoryId);
            if (!empty($request->productCategory)) {
                $product_categories->category_name = $request->productCategory;
            }
            if ($request->gender == 1) {
                $product_categories->gender = 'Men';
            }
            if ($request->gender == 2) {
                $product_categories->gender = 'Women';
            }
            if ($request->gender == 3) {
                $product_categories->gender = 'Kids';
            }
            $product_categories->save();
            return Response::json(['success' => true, 'message' => 'Product Category Updated']);
        }
        $product_categories = new product_categories();
        $product_categories->category_name = $request->productCategory;
        if ($request->gender == 1) {
            $product_categories->gender = 'Men';
        }
        if ($request->gender == 2) {
            $product_categories->gender = 'Women';
        }
        if ($request->gender == 3) {
            $product_categories->gender = 'Kids';
        }
        $product_categories->save();
        return Response::json(['success' => true, 'message' => 'Product Category Added']);
    }
    public function get_product_category(Request $request)
    {
        $categoryData = product_categories::where('id', $request->categoryId)->get()->first();
        return Response::json($categoryData);
    }
    public function delete_product_category(Request $request)
    {
        $product = Products::where('product_category', $request->categoryId)->get();
        if (empty($product)) {
            $product_categories = product_categories::find($request->categoryId);
            $product_categories->delete();
            return Response::json(['success' => true, 'message' => 'Product Category Deleted']);
        } else {
            return Response::json(['success' => false, 'message' => 'Product Category can not delete']);
        }
    }
    public function save_general_settings(Request $request)
    {

        if ($request->dark_logo) {
            $dark_logo = $request->dark_logo;
            $dark_logo_name = 'dark_logo.' . $dark_logo->getClientOriginalExtension();
            $request->dark_logo->move('logo', $dark_logo_name);
            $request->dark_logo = $dark_logo_name;
        }
        if ($request->light_logo) {
            $light_logo = $request->light_logo;
            $light_logo_name = 'light_logo.' . $light_logo->getClientOriginalExtension();
            $request->light_logo->move('logo', $light_logo_name);
            $request->light_logo = $light_logo_name;
        }
        if ($request->favicon) {
            $favicon = $request->favicon;
            $favicon_name = 'favicon.' . $favicon->getClientOriginalExtension();
            $request->favicon->move('logo', $favicon_name);
            $request->favicon = $favicon_name;
        }

        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                if (!empty($value)) {
                    if ($key == 'light_logo') {
                        $value = $light_logo_name;
                    }
                    if ($key == 'dark_logo') {
                        $value = $dark_logo_name;
                    }
                    if ($key == 'favicon') {
                        $value = $favicon_name;
                    }
                    set_option($key, $value);
                }
            }
        }
        return Redirect::back()->with('success', 'General Settings Saved successfully!');
    }
    public function remove_general_settings(Request $request)
    {
        $name = $request->name;
        unlink('logo/' . get_option($name));
        remove_option($request->name);
        echo json_encode('success');
    }
    public function save_settings_information(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($key != '_token' && $key != 'test_email') {
                if (!empty($value)) {
                    if ($key == 'email_encryption') {
                        if ($value == 1) {
                            set_option($key, 'SSL');
                        }
                        if ($value == 2) {
                            set_option($key, 'TLS');
                        }
                    } else {
                        set_option($key, $value);
                    }
                }
            }
        }
        if ($request->emailsettings == 1) {
            $this->setenv();
        }
        return Redirect::back()->with('success', 'Settings Saved successfully!');
    }
    public function testMail(Request $request)
    {
        if ($request->email !== "" && isset($request->email)) {
            Mail::to($request->email)->send(new TestMail());
            if (Mail::flushMacros()) {
                return (['icon' => 'error', 'message' => 'Sorry! Please try again latter']);
            } else {
                return (['icon' => 'success', 'message' => 'Great! Successfully send in your mail']);
            }
        }
    }
    public function setenv()
    {
        $data = array(
            ['MAIL_HOST' => get_option('smtp_host')],
            ['MAIL_PORT' => get_option('smtp_port')],
            ['MAIL_USERNAME' => get_option('smtp_username')],
            ['MAIL_PASSWORD' => get_option('smtp_password')],
            ['MAIL_ENCRYPTION' => get_option('email_encryption')],
            ['MAIL_ENCRYPTION' => get_option('email_encryption')]
        );
        $env = file_get_contents(base_path() . '/.env');
        $env = preg_split('/\s+/', $env);
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $k) {
                        $env[$env_key] = $k . "=" . $v;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path() . '/.env', $env);
        return Redirect::back()->with('success', 'Settings Saved successfully!');
    }

    public function role(RoleDatatable $datatable)
    {
        $permission = Permission::all();
        return $datatable->render('admin.settings.role', compact('permission'));
    }
    public function add_role(Request $request)
    {
        if (!empty($request->roleId) && isset($request->roleId)) {
            $role = Role::find($request->roleId);
            $role->name = $request->rolename;
            $role->save();
            $role->syncPermissions($request->permission);
            return Response::json(['success' => 'success', 'message' => 'Role Updated Successfully']);
        }
        $role = Role::create(['guard_name' => 'web', 'name' => $request->rolename]);
        $role->syncPermissions($request->permission);
        return Response::json(['success' => 'success', 'message' => 'Role Added Successfully']);
    }
    public function edit_role(Request $request)
    {
        $role = Role::find($request->id);
        $roleHasPermission = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $request->id)
            ->pluck('role_has_permissions.permission_id')
            ->all();
        return Response::json(['role' => $role, 'roleHasPermission' => $roleHasPermission]);        
    }
    public function delete_role(Request $request)
    {
        Role::where('id', $request->id)->delete();
        return Response::json(['success' => 'success', 'message' => 'Role Deleted Successfully']);

    }

    public function permission(PermissionDatatable $datatable)
    {
        return $datatable->render('admin.settings.permission');
    }

    public function add_permission(Request $request)
    {
        if(!empty($request->permissionId) && isset($request->permissionId)){
            $permission = Permission::find($request->permissionId);
            $permission->name = $request->permissionName;
            $permission->save();
            return Response::json(['success' => 'success', 'message' => 'Permission Updated Successfully']);
        }
        Permission::create(['guard_name' => 'web','name' => $request->permissionName]);
        return Response::json(['success' => 'success', 'message' => 'Permission Added Successfully']);
    }

    public function edit_permission(Request $request)
    {
        $permission = Permission::find($request->id);
        return Response::json($permission);
    }

    public function delete_permission(Request $request)
    {
        Permission::where('id', $request->id)->delete();
        return Response::json(['success' => 'success', 'message' => 'Permission Deleted Successfully']);
    }
}
