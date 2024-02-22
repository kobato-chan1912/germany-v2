<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('configs', function (Blueprint $table) {
//            $table->id();
//            $table->string('config_name');
//            $table->string("config_value", 2500)->nullable();
//            $table->timestamps();
//        });
//        \App\Models\Config::insert([
//            ["config_name" => "home_title"],
//            ["config_name" => "home_description"],
//            ["config_name" => "youtube"],
//            ["config_name" => "facebook"],
//            ["config_name" => "twitter"],
//            ["config_name" => "pinterest"],
//            ["config_name" => "telegram"],
//            ["config_name" => "tiktok"],
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
