<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTable extends Migration
{
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('destination');
            $table->text('purpose');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('travel');
    }
}
