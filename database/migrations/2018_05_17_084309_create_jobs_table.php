<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->SoftDeletes();
            $table->integer('user_id')->unsigned();
            $table->string('job_title')->nullable();
            $table->string('time_type')->nullabel();
            $table->text('skill_tag')->nullable();
            $table->text('job_description')->nullable();
            $table->text('skill_requirement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
