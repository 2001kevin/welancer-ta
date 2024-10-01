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
        Schema::create('mapping_sub_grups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('mapping_grup_id');
            $table->unsignedBigInteger('detail_transaksi_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->string('nama');
            $table->decimal('keuntungan_bersih', 10,0)->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksis');
            $table->foreign('mapping_grup_id')->references('id')->on('mapping_grups');
            $table->foreign('detail_transaksi_id')->references('id')->on('detail_transaksis');
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapping_sub_grups');
    }
};
