<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmPeopleMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_film_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('people_id')->unsigned()->nullable()->foreign('people_id')->references('id')->on('people');
            $table->integer('film_id')->unsigned()->nullable()->foreign('film_id')->references('id')->on('film');
            $table->integer('created_by')->unsigned()->nullable()->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->unsigned()->nullable()->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('film_people_mapping');
    }
}
