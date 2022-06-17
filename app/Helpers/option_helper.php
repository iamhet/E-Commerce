<?php

use App\Models\options;

if (! function_exists('get_option')) {
    function get_option($name)
    {
        return options::where('name','=',$name)->pluck('value')->first();
    }
}
