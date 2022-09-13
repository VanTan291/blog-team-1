<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('categories_id')->nullable();
            $table->integer('series_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('description')->nullable();
            $table->integer('views')->nullable()->comment('number of views');
            $table->integer('favorites')->nullable()->comment('number of favorites');
            $table->tinyInteger('is_published')->default(false)->comment('0: in active, 1: active');
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
