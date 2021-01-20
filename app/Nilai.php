<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['karyawan_id', 'nama', 'k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'total'];

    public $timestamps = true;

    public function karyawan() 
    {
        return $this->belongsTo('App\Karyawan');
    }
}
