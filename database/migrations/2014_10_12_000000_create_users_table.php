<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->integer	('type');
            $table->string('device_token')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('apple_token')->nullable();
            $table->string('google_token')->nullable();
            $table->string('snapchat_token')->nullable();
            $table->boolean('is_verfied')->default(0);
            $table->string('language')->nullable();
            $table->boolean('state')->default(0);

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
