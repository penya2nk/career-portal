<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPivotUserParameter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_parameter', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->SoftDeletes();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('parameter_id')->unsigned();
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
            $table->integer('score')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_parameter');
    }
}
