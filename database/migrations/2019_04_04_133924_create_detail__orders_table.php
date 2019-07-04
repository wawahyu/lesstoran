<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->index();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');
            $table->integer('id_order')->unsigned()->index()->nullable();
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('restrict');
            $table->integer('id_masakan')->unsigned()->index();
            $table->foreign('id_masakan')->references('id')->on('masakans')->onDelete('restrict');
            $table->integer('qty')->length(5);
            $table->string('keterangan', 150)->default('-');
            $table->integer('status')->length(1)->default('1');
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
        Schema::dropIfExists('detail_orders');
    }
}
