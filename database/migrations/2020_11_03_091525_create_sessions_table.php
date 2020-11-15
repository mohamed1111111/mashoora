<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vendor_id');
            $table->string('title');
            $table->string('price');
            $table->dateTime('date');
            $table->string('total_minutes');
            $table->integer('max_number_of_attendees')->default(1);
            $table->integer('bookings_number')->default(1);
            $table->string('vendor_url')->nullable();
            $table->string('attendees_url')->nullable();
            $table->string('recording_url')->nullable();
            $table->boolean('is_requested_from_customer')->default(1);

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
        Schema::dropIfExists('sessions');
    }
}
