<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserSubmitPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_parameter', function (Blueprint $table) {
            $table->string('user_submit')->nullable();
            $table->decimal('score')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_parameter', function (Blueprint $table) {
            $table->dropColumn('user_submit');
        });
    }
}
