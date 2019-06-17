<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pembelian', function (Blueprint $table) {
      $table->string('id', 5)->primary();
      $table->string('tanggal');
      $table->string('id_bar', 5);
      $table->integer('jmlh_beli');
      $table->integer('total_hrg');
      $table->bigInteger('id_user')->unsigned();
      $table->integer('dosis')->default(0);
      $table->date('tgl_habis');
    });

    Schema::table('pembelian', function ($table) {
      $table->foreign('id_bar')->references('id')->on('barang');
      $table->foreign('id_user')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('pembelians');
  }
}
