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
        Schema::create('tbl_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim',8)->unique();
            $table->string('nama_mahasiswa',50);
            $table->string('judul_tugas_akhir',150);
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
        Schema::dropIfExists('tbl_mahasiswa');
    }
};