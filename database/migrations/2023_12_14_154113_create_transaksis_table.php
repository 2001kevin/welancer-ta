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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pegawai_id')->default('0');
            $table->unsignedBigInteger('kategori_id');
            $table->decimal('jumlah_harga')->default('0');
            $table->string('status')->default('On Negotiations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            $table->foreign('kategori_id')->references('id')->on('kategoris');
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
};
