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
            ['name'=>'headerBackground', 'value'=> 'header-dark'],
            ['name'=>'navigationBackground', 'value'=> 'sidebar-dark'],
            ['name'=>'menuDropdownIcon', 'value'=> 'icon-style-3'],
            ['name'=>'menuListIcon', 'value'=>'icon-list-style-4']
        ];
        options::insert($data);
    }
}
