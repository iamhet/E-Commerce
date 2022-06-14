<?php

namespace Database\Seeders;

use App\Models\options;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'header_background', 'value'=> 'white'],
            ['name'=>'sidebar_background', 'value'=> 'white'],
            ['name'=>'menu_dropdown_icon', 'value'=> 'single_arrow'],
            ['name'=>'menu_list_icon', 'value'=>'minus']
        ];
        options::insert($data);
    }
}
