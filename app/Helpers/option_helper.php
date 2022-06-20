<?php

use App\Models\options;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

if (!function_exists('get_option')) {
    function get_option($name)
    {
        return options::where('name', '=', $name)->pluck('value')->first();
    }
}

if (!function_exists('set_option')) {
    function set_option($name, $value)
    {
        $option = options::select('id')->where('name', $name)->get();

        if (count($option) > 0) {
            $option_data = options::where('name', $name)->first();
            $option_data->name = $name;
            $option_data->value = $value;
            $option_data->save();
            return true;
        }
        if (count($option) == 0) {
            $option_data = new options();
            $option_data->name = $name;
            $option_data->value = $value;
            $option_data->save();
        }
        return true;
    }
}

if (!function_exists('remove_option')) {
    function remove_option($name)
    {
        return options::where('name',$name)->delete();
    }
}