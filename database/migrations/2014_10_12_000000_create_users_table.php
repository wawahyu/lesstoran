<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->primaryKey();
            $table->string('name',50);
            $table->string('username',50)->unique();
            $table->string('email',50)->unique();
            $table->string('password');
            $table->integer('id_role')->unsigned()->index()->default('5');
            $table->foreign('id_role')->references('id')->on('roles')->onDelete('restrict');
            $table->Integer('active', false, false)->length(6)->default('1');
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
        Schema::dropIfExists('users');
    }
}