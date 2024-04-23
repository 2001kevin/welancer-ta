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
        Schema::create('detail_diskusis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diskusi_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('user_id');
            $table->string('text');
            $table->foreign('diskusi_id')->references('id')->on('diskusis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('detail_diskusis');
    }
};
