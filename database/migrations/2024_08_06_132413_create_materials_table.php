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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('detail');
            $table->string('link');
            $table->unsignedBigInteger('detail_transaksi_id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('detail_transaksi_id')->references('id')->on('detail_transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
