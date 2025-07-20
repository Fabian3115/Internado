<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterPrestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_prestations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->integer('hours');
            $table->date('activity_date');
            $table->integer('total_hours')->default(0)->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('counter_prestations');
    }
}
