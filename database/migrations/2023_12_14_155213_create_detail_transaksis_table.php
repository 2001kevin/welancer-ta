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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('jasa_id');
            $table->integer('qty');
            $table->integer('Minharga_total');
            $table->integer('Maxharga_total');
            $table->string('status')->default('On Negotiations');
            $table->foreign('transaksi_id')->references('id')->on('transaksis');
            $table->foreign('jasa_id')->references('id')->on('jasas');
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
        Schema::dropIfExists('detail_transaksis');
    }
};
