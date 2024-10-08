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
        Schema::create('mapping_sub_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapping_sub_grup_id');
            $table->unsignedBigInteger('rincian_jasa_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->decimal('presentasi_gaji')->nullable();
            $table->decimal('gaji', 10,2)->default(0)->nullable();
            $table->timestamps();
            $table->foreign('mapping_sub_grup_id')->references('id')->on('mapping_sub_grups');
            $table->foreign('rincian_jasa_id')->references('id')->on('rincian_jasas');
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
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
        Schema::dropIfExists('mapping_sub_projects');
    }
};
