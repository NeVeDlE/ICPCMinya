<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('tag');
            $table->text('description');
            $table->unsignedBigInteger('mentor');
            $table->text('date');
            $table->string('img');
            $table->text('topics');
            $table->foreign('mentor')->references('id')->on('about_pages')->onDelete('cascade');

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
        Schema::dropIfExists('training_pages');
    }
}
