<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    
    protected $table = 'status';
    
    protected $fillable = ['karyawan_id', 'created_at', 'updated_at', 'status_kepbag', 'status_admin'];
    
    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }

    public function scopeWhereDepartemen($query, $dep1, $dep2 = null){
        if(!empty($dep2)) return $query->whereIn('departemen', [$dep1, $dep2]);
        return $query->where('departemen', $dep1);
    }

}
