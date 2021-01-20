<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateKaryawansTable extends Migration
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
            $table->string('nama', 35);
            $table->string('bagian', 40);
            $table->string('divisi', 100);
            $table->string('jenis_kelamin', 11);
            $table->string('ibu_kandung', 35);
            $table->string('tempat_lahir', 35);
            $table->date('tanggal_lahir');
            $table->string('alamat', 150);
            $table->string('pendidikan_terakhir', 10);
            $table->string('nama_sekolah', 25);
            $table->smallInteger('tahun_lulus');
            $table->string('kewarganegaraan', 15);
            $table->string('status_perkawinan', 15);
            $table->string('agama', 15);
            $table->string('no_telp', 15);
            $table->string('no_rek', 20);
            $table->string('no_induk_karyawan', 20);
            $table->string('no_jamsostek', 20);
            $table->date('tanggal_masuk')->nullable();
            $table->date('resign');
            $table->string('nik_ktp', 20);
            $table->date('berakhir_kontrak', 20);
            $table->integer('status');
            $table->string('ket', 25);
            $table->string('info', 25);
            $table->string('report', 25);
            $table->string('foto', 5000);
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
