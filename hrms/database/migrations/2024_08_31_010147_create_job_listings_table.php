<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('job_title', 255);
            $table->string('department', 100);
            $table->enum('job_type', ['Full-time', 'Part-time', 'Contract']);
            $table->string('salary_range', 50);
            $table->enum('experience_level', ['Entry-level', 'Mid-level', 'Senior-level']);
            $table->string('education_requirement', 100);
            $table->text('job_description');
            $table->text('key_responsibilities');
            $table->text('required_skills');
            $table->date('application_deadline');
            $table->date('posted_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_listings');
    }
}
