<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'bagian', 'no_induk_karyawan','jenis_kelamin', 'ibu_kandung', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'departemen', 'kewarganegaraan', 'status_perkawinan', 'agama', 'tanggal_masuk', 'berakhir_kontrak', 'status','foto'];

    public $timestamps = true;

    public function nilai()
    {
        return $this->hasOne('App\Nilai');
    }

    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
