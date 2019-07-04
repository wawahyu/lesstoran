<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned()->index();
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('restrict');
            $table->integer('id_user')->unsigned()->index();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');
            $table->integer('total_bayar')->length(20);
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
        Schema::dropIfExists('transaksis');
    }
}
