<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->unique();
            $table->string('nama');
            $table->string('k1', 3);
            $table->string('k2', 3);
            $table->string('k3', 3);
            $table->string('k4', 3);
            $table->string('k5', 3);
            $table->string('k6', 3);
            $table->string('k7', 3);
            $table->string('total', 3);
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
        Schema::dropIfExists('nilais');
    }
}
