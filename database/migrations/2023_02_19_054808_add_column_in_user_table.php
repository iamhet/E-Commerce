<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profileImage')->nullable();
            $table->string('address')->nullable();
            $table->integer('phonenumber')->nullable();
            $table->tinyInteger('administrator')->default('0');
            $table->string('facebookLink')->nullable();
            $table->string('instagramLink')->nullable();
            $table->string('twitterLink')->nullable();
            $table->string('linkedInLink')->nullable();
            $table->string('skypeLink')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('profileImage');
            $table->dropColumn('phonenumber');
            $table->dropColumn('address');
            $table->dropColumn('administrator');
            $table->dropColumn('facebookLink');
            $table->dropColumn('instagramLink');
            $table->dropColumn('twitterLink');
            $table->dropColumn('linkedInLink');
            $table->dropColumn('skypeLink');
        });
    }
};
