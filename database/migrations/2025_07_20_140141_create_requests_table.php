<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->text('reason');
            $table->dateTime('departure_date');
            $table->dateTime('return_date')->nullable();
            $table->string('destination')->nullable();
            $table->text('observations')->nullable();
            $table->enum('status',['pendiente', 'aprobada', 'rechazada']);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
