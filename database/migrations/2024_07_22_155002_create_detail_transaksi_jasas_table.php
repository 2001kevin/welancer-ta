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
        Schema::create('detail_transaksi_jasas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_transaksi_id');
            $table->unsignedBigInteger('detail_jasa_id');
            $table->integer('qty');
            $table->decimal('harga', 10,0);
            $table->foreign('detail_transaksi_id')->references('id')->on('detail_transaksis');
            $table->foreign('detail_jasa_id')->references('id')->on('rincian_jasas');
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
        Schema::dropIfExists('detail_transaksi_jasas');
    }
};
