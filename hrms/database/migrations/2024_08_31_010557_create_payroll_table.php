<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTable extends Migration
{
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->date('date_from');
            $table->date('date_to');
            $table->enum('type', ['monthly', 'semi-monthly']);
            $table->enum('status', ['New', 'Computed'])->default('New');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payroll');
    }
}
