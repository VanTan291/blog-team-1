<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('city')->nullable();
            $table->integer('district')->nullable();
            $table->integer('wards')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('education')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
