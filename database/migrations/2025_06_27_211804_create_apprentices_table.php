<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprenticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('benefit_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade')->unique();
            $table->foreignId('program_id')->constrained()->onDelete('cascade')->unique();
            $table->enum('state', ['Activo', 'Inactivo', 'Graduado', 'Retirado'])->default('Activo');
            $table->string('Tutor_name')->nullable();
            $table->string('Tutor_last_name')->nullable();
            $table->bigInteger('Tutor_number_phone')->nullable();
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
        Schema::dropIfExists('apprentices');
    }
}
