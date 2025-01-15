<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name'); // For storing the system name
            $table->string('main_color')->default('#000000'); // Default to black
            $table->string('background_color')->default('#ffffff'); // Default to white
            $table->string('text_color')->default('#000000'); // Default to black
            $table->string('logo')->nullable(); // Path to logo image
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
