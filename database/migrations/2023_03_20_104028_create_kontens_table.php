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
		Schema::create('kontens', function (Blueprint $table) {
			$table->id();
			$table->string('judul');
			$table->string('judul_eng')->nullable();
			$table->string('slug')->nullable();
			$table->string('slug_eng')->nullable();
			$table->text('kutipan')->nullable();
			$table->text('kutipan_eng')->nullable();
			$table->string('nomor_siaran_pers')->nullable();
			$table->text('isi_konten')->nullable();
			$table->text('isi_konten_eng')->nullable();
			$table->unsignedBigInteger('galeri_id');
			$table->string('lampiran')->nullable();
			$table->string('penulis');
			$table->unsignedBigInteger('kategori_id');
			$table->string('tag')->nullable();
			$table->string('status');
			$table->date('tanggal_terbit')->nullable();
			$table->time('jam_terbit')->nullable();
			$table->string('gambar_cover')->nullable();
			$table->string('gambar_slider')->nullable();
			$table->tinyInteger('featured')->nullable();
			$table->tinyInteger('featured_eng')->nullable();
			$table->tinyInteger('sticky')->nullable();
			$table->tinyInteger('sticky_eng')->nullable();
			$table->tinyInteger('is_gpr')->nullable();
			$table->timestamps();


			$table->foreign('kategori_id')
				->references('id')
				->on('kategoris')
				->onDelete('cascade');

			$table->foreign('galeri_id')
				->references('id')
				->on('galeris')
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
		Schema::dropIfExists('kontens');
	}
};
