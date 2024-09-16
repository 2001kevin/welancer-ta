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
        Schema::create('detail_pakets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jasa_id');
            $table->unsignedBigInteger('paket_jasa_id');
            $table->foreign('jasa_id')->references('id')->on('jasas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('paket_jasa_id')->references('id')->on('paket_jasas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('detail_pakets');
    }
};
