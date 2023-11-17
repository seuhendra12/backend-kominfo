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
        Schema::create('halamans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi_konten');
            $table->string('penulis');
            $table->string('tag')->nullable();
            $table->string('status');
			$table->date('tanggal_terbit')->nullable();
			$table->time('jam_terbit')->nullable();
			$table->string('gambar_cover')->nullable();
			$table->string('lampiran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halamans');
    }
};
