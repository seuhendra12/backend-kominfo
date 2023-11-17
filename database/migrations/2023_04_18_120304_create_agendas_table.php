<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('agendas', function (Blueprint $table) {
      $table->id();
      $table->string('judul');
      $table->string('slug')->nullable();
      $table->unsignedBigInteger('unitKerja_id');
      $table->dateTime('tanggal_mulai');
      $table->dateTime('tanggal_selesai');
      $table->string('lokasi');
      $table->text('deskripsi')->nullable();
      $table->string('tautan')->nullable();
      $table->string('surel')->nullable();
      $table->string('penulis');
      $table->string('status');
      $table->string('gambar')->nullable();
      $table->timestamps();

      $table->foreign('unitKerja_id')
				->references('id')
				->on('unit_kerjas')
				->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('agendas');
  }
};
