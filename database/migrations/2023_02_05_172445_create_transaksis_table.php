<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

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
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_invoice')->unique();
            $table->dateTime('tgl');
            $table->dateTime('batas_waktu');
            $table->dateTime('tgl_bayar')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('pajak');
            $table->integer('sub_total');
            $table->integer('qty_total');
            $table->integer('total_bayar');
            $table->integer('cash')->nullable();
            $table->integer('kembalian')->nullable();
            $table->enum('status',['baru','proses','selesai','diambil']);
            $table->enum('dibayar',['dibayar','belum_bayar']);
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
