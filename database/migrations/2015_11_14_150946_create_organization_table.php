<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 64);
            $table->string('name');
            $table->string('email');
            $table->string('type');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('lat');
            $table->string('lon');
            $table->text('description');
            $table->integer('capacity');
            $table->integer('reserved');
            $table->rememberToken();
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
        Schema::drop('organizations');
    }
}
