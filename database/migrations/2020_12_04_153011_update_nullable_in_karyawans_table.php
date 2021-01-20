<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableInKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('nama', 35)->nullable()->change();
            $table->string('bagian', 40)->nullable()->change();
            $table->string('divisi', 100)->nullable()->change();
            $table->string('jenis_kelamin', 11)->nullable()->change();
            $table->string('ibu_kandung', 35)->nullable()->change();
            $table->string('tempat_lahir', 35)->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('alamat', 150)->nullable()->change();
            $table->string('pendidikan_terakhir', 10)->nullable()->change();
            $table->string('nama_sekolah', 25)->nullable()->change();
            $table->smallInteger('tahun_lulus')->nullable()->change();
            $table->string('status_perkawinan', 15)->nullable()->change();
            $table->string('agama', 15)->nullable()->change();
            $table->string('no_telp', 15)->nullable()->change();
            $table->string('no_rek', 20)->nullable()->change();
            $table->string('no_induk_karyawan', 20)->nullable()->change();
            $table->string('no_jamsostek', 20)->nullable()->change();
            $table->date('resign')->nullable()->change();
            $table->string('nik_ktp', 20)->nullable()->change();
            $table->date('berakhir_kontrak', 20)->nullable()->change();
            $table->integer('status')->nullable()->change();
            $table->string('ket', 25)->nullable()->change();
            $table->string('info', 25)->nullable()->change();
            $table->string('report', 25)->nullable()->change();
            $table->string('foto', 5000)->nullable()->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('nama', 35)->change();
            $table->string('bagian', 40)->change();
            $table->string('divisi', 100)->change();
            $table->string('jenis_kelamin', 11)->change();
            $table->string('ibu_kandung', 35)->change();
            $table->string('tempat_lahir', 35)->change();
            $table->date('tanggal_lahir')->change();
            $table->string('alamat', 150)->change();
            $table->string('pendidikan_terakhir', 10)->change();
            $table->string('nama_sekolah', 25)->change();
            $table->smallInteger('tahun_lulus')->change();
            $table->string('status_perkawinan', 15)->change();
            $table->string('agama', 15)->change();
            $table->string('no_telp', 15)->change();
            $table->string('no_rek', 20)->change();
            $table->string('no_induk_karyawan', 20)->change();
            $table->string('no_jamsostek', 20)->change();
            $table->date('resign')->change();
            $table->string('nik_ktp', 20)->change();
            $table->date('berakhir_kontrak', 20)->change();
            $table->integer('status')->change();
            $table->string('ket', 25)->change();
            $table->string('info', 25)->change();
            $table->string('report', 25)->change();
            $table->string('foto', 5000)->change();
        });
    }
}
