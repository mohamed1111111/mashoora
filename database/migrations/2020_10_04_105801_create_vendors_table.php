<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->string('profile_image');
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('bio_en')->nullable();
            $table->string('bio_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('area_id')->nullable();
            $table->string('hour_price')->nullable();
            $table->boolean('state')->default(0);;
            $table->integer('total_booking')->nullable();
            $table->integer('total_reviews')->nullable();
            $table->double('rating')->nullable();
            $table->integer('total_wallet')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
