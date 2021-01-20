<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ['karyawan_id', 'kriteria_id', 'nilai', 'created_at', 'updated_at'];

    public function karyawan() 
    {
        return $this->belongsTo('App\Karyawan');
    }

}
