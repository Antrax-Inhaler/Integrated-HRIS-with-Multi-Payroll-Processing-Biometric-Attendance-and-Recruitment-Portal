<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('member_bonuses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade'); // Foreign key reference to members table
            $table->string('bonus_name'); // Name of the bonus
            $table->text('description')->nullable(); // Description of the bonus
            $table->decimal('amount', 10, 2); // Amount of the bonus
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_bonuses');
    }
}
