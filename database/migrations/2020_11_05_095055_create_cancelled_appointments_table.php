<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelledAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelled_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('appointment_id')->unsigned();
            $table->foreign('appointment_id')->references('id')->on('appointments');

            $table->string('justification')->nullable();
            
            $table->bigInteger('cancelled_by_id')->unsigned();
            $table->foreign('cancelled_by_id')->references('id')->on('users');


            $table->timestamps(); // created_at (cancelled_at), updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancelled_appointments');
    }
}
