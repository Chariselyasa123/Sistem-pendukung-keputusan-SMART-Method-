<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use App\Karyawan;

class TotalComposer
{
    public function compose(View $view)
    {
        $office = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get()->count();
        $intake = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get()->count();
        $warehousing = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->get()->count();
        $produksi = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->get()->count();
        $qclab = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'qclab')->get()->count();
        $ga = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get()->count();
        $truckscale = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get()->count();
        $premix = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix')->get()->count();
        $maintance = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->get()->count();
        $kebersihan = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get()->count();
        $view->with(compact('office', 'intake', 'warehousing', 'produksi', 'ga', 'premix', 'maintance', 'truckscale', 'kebersihan', 'qclab'));
    }
}