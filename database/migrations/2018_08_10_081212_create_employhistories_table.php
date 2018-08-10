<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employhistories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id');
            $table->string('cv_type');
            $table->string('cv_position');
            $table->string('cv_company');
            $table->string('cv_city');
            $table->string('cv_description');
            $table->string('y1_sdmcv');
            $table->string('y2_sdmcv');
            $table->string('user_submit');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employhistories');
    }
}
