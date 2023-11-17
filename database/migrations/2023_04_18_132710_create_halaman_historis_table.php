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
        Schema::create('halaman_historis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('halaman_id');
            $table->timestamps();

            $table->foreign('halaman_id')
                ->references('id')->on('halamans')
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
        Schema::dropIfExists('halaman_historis');
    }
};
