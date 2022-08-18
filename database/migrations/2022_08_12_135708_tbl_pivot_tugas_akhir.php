<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_pivot_tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->integer('dosbing1_id');
            $table->integer('dosbing2_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('tbl_pivot_tugas_akhir');
    }
};