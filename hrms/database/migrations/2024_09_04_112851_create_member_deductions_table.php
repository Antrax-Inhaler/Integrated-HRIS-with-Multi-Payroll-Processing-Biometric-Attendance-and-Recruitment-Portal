<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_deductions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID

            // Foreign key to members table
            $table->foreignId('member_id')
                ->constrained('members')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Foreign key to deductions table
            $table->foreignId('deduction_id')
                ->constrained('deductions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->tinyInteger('type')->comment('1 = Monthly, 2 = Semi-Monthly, 3 = Once');
            $table->float('amount');
            $table->date('effective_date');

            // Laravel automatically manages these timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_deductions');
    }
}
