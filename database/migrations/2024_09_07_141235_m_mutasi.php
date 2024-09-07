<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_mutasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('m_barang_id')
                ->comment('Fill dengan id dari table m_barang');
            $table->string('m_users_id')
                ->comment('Fill dengan id dari table users');
            $table->enum('jenis_mutasi', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
