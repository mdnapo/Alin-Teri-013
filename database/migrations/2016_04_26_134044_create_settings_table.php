<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('setting_category_id')->unsigned();
            $table->integer('setting_type_id')->unsigned();
            $table->string('name');
            $table->string('value');
            $table->string('possible_values')->nullable();
            $table->timestamps();

            $table->foreign('setting_category_id')->references('id')->on('setting_categories');
            $table->foreign('setting_type_id')->references('id')->on('setting_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
