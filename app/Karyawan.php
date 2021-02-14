<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'bagian', 'no_induk_karyawan','jenis_kelamin', 'ibu_kandung', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'pendidikan_terakhir', 'departemen', 'kewarganegaraan', 'status_perkawinan', 'agama', 'tanggal_masuk', 'berakhir_kontrak', 'status','foto'];

    public $timestamps = true;

    public function data()
    {
        return $this->hasMany('App\Data');
    }
    
    public function status()
    {
        return $this->hasOne('App\Status');
    }

    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
