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
        Schema::create('termin_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->string('nama');
            $table->date('tanggal_termin');
            $table->decimal('jumlah_pembayaran');
            $table->string('status_pembayaran');
            $table->string('status_termin');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transaction_time')->nullable();
            $table->string('currency')->nullable();
            $table->string('order_id')->nullable();
            $table->string('status_code')->nullable();
            $table->string('signature_key')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('expiry_time')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('termin_pembayarans');
    }
};
