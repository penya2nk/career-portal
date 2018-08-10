<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalDataInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nick_name')->after('name')->nullable();
            $table->string('first_name')->after('name')->nullable();
            $table->string('middle_name')->after('name')->nullable();
            $table->string('last_name')->after('name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('nick_name');
          $table->dropColumn('first_name');
          $table->dropColumn('middle_name');
          $table->dropColumn('last_name');
        });
    }
}
