<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        $options = array(
            ['name' => 'headerBackground','value' => '#51647c'],
            ['name' => 'navigationBackground','value' => '#626f80'],
            ['name' => 'menuDropdownIcon','value' => 'icon-style-3'],
            ['name' => 'menuListIcon','value' => 'icon-list-style-5'],
        );
        DB::table('options')
        ->insert($options);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
};
