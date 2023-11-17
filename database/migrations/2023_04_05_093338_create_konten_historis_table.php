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
        Schema::create('konten_historis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konten_id');
            $table->timestamps();

            $table->foreign('konten_id')
                ->references('id')->on('kontens')
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
        Schema::dropIfExists('konten_historis');
    }
};
