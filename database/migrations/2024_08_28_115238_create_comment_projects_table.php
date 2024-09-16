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
        Schema::create('comment_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('senderUser_id');
            $table->unsignedBigInteger('senderPegawai_id');
            $table->unsignedBigInteger('project_id');
            $table->text('comment');
            $table->foreign('senderUser_id')->references('id')->on('users');
            $table->foreign('senderPegawai_id')->references('id')->on('pegawais');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('comment_projects');
    }
};
