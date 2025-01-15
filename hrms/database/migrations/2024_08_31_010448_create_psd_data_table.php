<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsdDataTable extends Migration
{
    public function up()
    {
        Schema::create('psd_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('applicants');
            $table->string('personal_info');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psd_data');
    }
}
