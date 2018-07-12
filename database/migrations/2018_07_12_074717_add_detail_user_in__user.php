<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailUserInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('token')->nullable();
          $table->date('born_date')->nullable();
          $table->string('phone')->nullable();
          $table->string('gender')->nullable();
          $table->string('marital_status')->nullable();
          $table->text('address')->nullable();
          $table->text('profpic')->nullable();
          $table->text('resume')->nullable();
          $table->string('last_education')->nullable();
          $table->string('institution')->nullable();
          $table->string('major')->nullable();
          $table->string('graduation_year')->nullable();
          $table->float('gpa')->nullable();
          $table->float('gpa_max')->nullable();
          $table->integer('status')->default(0);
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
          $table->dropColumn('token');
          $table->dropColumn('born_date');
          $table->dropColumn('phone');
          $table->dropColumn('gender');
          $table->dropColumn('marital_status');
          $table->dropColumn('address');
          $table->dropColumn('profpic');
          $table->dropColumn('resume');
          $table->dropColumn('last_education');
          $table->dropColumn('institution');
          $table->dropColumn('major');
          $table->dropColumn('graduation_year');
          $table->dropColumn('gpa');
          $table->dropColumn('gpa_max');
          $table->dropColumn('status');
        });
    }
}
