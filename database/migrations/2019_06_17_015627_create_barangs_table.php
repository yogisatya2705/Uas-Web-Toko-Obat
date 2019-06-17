<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('barang', function (Blueprint $table) {
      $table->string('id', 5)->primary();
      $table->string('nama');
      $table->integer('stok');
      $table->integer('harga');
      $table->integer('point')->default(0);
      // $table->integer('dosis');
      $table->string('id_sup', 5);
      // $table->timestamps();
    });

    Schema::table('barang', function ($table) {
      $table->foreign('id_sup')->references('id')->on('supplier');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('barangs');
  }
}
