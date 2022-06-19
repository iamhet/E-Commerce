<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class options extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'value'
    ];

    public static function set_option_data($id,$name,$value)
    {
        $option = options::find($id);
        $option->name = $name;
        $option->value = $value;
        $option->save();
        return true;
    }
}
