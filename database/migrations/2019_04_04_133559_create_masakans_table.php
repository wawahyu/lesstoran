<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masakans', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nama', 100);
            $table->integer('harga')->length(10);
            $table->integer('keterangan')->length(11);
            $table->integer('status')->length(1)->default('1');
            $table->Text('image');
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
        Schema::dropIfExists('masakans');
    }
}
