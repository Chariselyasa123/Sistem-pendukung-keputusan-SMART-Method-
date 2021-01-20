<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk_karyawan', 14);
            $table->string('nama', 40);
            $table->string('bagian', 25);
            $table->string('departemen', 25);
            $table->string('jenis_kelamin', 11);
            $table->string('tempat_lahir', 35);
            $table->date('tanggal_lahir');
            $table->string('alamat', 150);
            $table->string('ibu_kandung', 35);
            $table->string('pendidikan_terakhir', 4);
            $table->string('kewarganegaraan', 15);
            $table->string('status_perkawinan', 6);
            $table->string('agama', 15);
            $table->date('tanggal_masuk');
            $table->date('berakhir_kontrak');
            $table->integer('status')->nullable();
            $table->string('foto', 5000)->nullable();
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
        Schema::dropIfExists('karyawans');
    }
}
