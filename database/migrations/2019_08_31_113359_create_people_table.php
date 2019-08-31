<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('index')->unique();
            $table->string('name', 255);
            $table->integer('height');
            $table->string('unit_of_height')->default('cm');
            $table->text('films')->nullable();
            $table->string('status', 1)->default('A');
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
        Schema::dropIfExists('people');
    }
}
