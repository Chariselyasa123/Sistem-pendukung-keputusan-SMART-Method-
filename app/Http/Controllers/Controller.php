<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Karyawan;
use App\Data;
use App\Kriteria;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getData($request, String $from = null)
    {
        if ($from == 'karyawan') {
            switch ($request->get('dep')) {
                case 'admin':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan')) : $query->whereMonth('berakhir_kontrak', Carbon::now()->month);})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'intake':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'intake') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'intake');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'warehouse':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'warehousing') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'warehousing');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'produksi':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->whereIn('departemen', ['hand add', 'produksi']) : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereIn('departemen', ['hand add', 'produksi']);})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'ga':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'ga') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'ga');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'lab':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'lab') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'lab');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'truck':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'truck scale') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'truck scale');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'premix':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'premix') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'premix');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'maintenance':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'maintenance') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'maintenance');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
                case 'kebersihan':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'kebersihan') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'kebersihan');})->addColumn('action', function($row){$actionBtn = 'Hapus'; return $actionBtn;})->rawColumns(['action'])->make(true);
            }
        }else{
            switch ($request->get('dep')) {
                case 'admin':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan')) : $query->whereMonth('berakhir_kontrak', Carbon::now()->month);})->make(true);
                case 'intake':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'intake') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'intake');})->make(true);
                case 'warehouse':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'warehousing') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'warehousing');})->make(true);
                case 'produksi':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->whereIn('departemen', ['hand add', 'produksi']) : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereIn('departemen', ['hand add', 'produksi']);})->make(true);
                case 'ga':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'ga') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'ga');})->make(true);
                case 'lab':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'lab') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'lab');})->make(true);
                case 'truck':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'truck scale') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'truck scale');})->make(true);
                case 'premix':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'premix') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'premix');})->make(true);
                case 'maintenance':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'maintenance') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'maintenance');})->make(true);
                case 'kebersihan':
                    $data = Karyawan::with('status', 'data');
                    return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){(!empty($request->get('bulan'))) ? $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'kebersihan') : $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->where('departemen', 'kebersihan');})->make(true);
            }
        }
    }

    public function smartMethod(String $bulan = null){
        // Memanggil data penilaian dari tabel data
        $nilai = Data::orderBy('karyawan_id', 'asc')->orderBy('kriteria_id', 'asc')->get();
        // Memanggil alternatif (Karyawan Habis Kontrak)
        $dataKaryawan = Karyawan::whereMonth('berakhir_kontrak', (!$bulan) ?  Carbon::now()->month : $bulan)->get();
        // Manggil Bobot
        $kriteria = Kriteria::get();

        // Pengambilan Nilai Kriteria
        $kriterias = [];
        foreach ($kriteria as $k){
            $kriterias[$k->id]=array($k->kriteria,$k->bobot,$k->tipe,$k->id);
        }
        // Pengambilan Nilai Penilaian
        $sample = [];
        foreach ($nilai as $n => $v) {
            $sample[$v->karyawan_id][$v->kriteria_id]=$v->nilai;
        }

        $zero = Karyawan::select('id')->whereMonth('berakhir_kontrak', (!$bulan) ?  Carbon::now()->month : $bulan)->whereNotIn('id', function($query){
            $query->select('karyawan_id')->from('data');
        })->get();

        if($zero) {
            foreach($zero as $z){
                foreach ($nilai as $n) {
                    $sample[$z->id][$n->kriteria_id] = null;
                }
            }
        }

        // Pengambilan Nilai Alternatif
        $alternatif = [];
        foreach($dataKaryawan as $d){
            $alternatif[$d->id]=$d->nama;
        }

        // Inisialisasi variabel array bobot
        $bobot = [];
        foreach ($kriteria as $k => $val) {
            $bobot[$val->id] = $val->bobot;
        }
        // Menghitung nilai total bobot
        $totalBobot = array_sum($bobot);

        // Inisialisasi variabel array w (bobot ternormalisasi)
        $w=[];
        // Normalisasi bobot
        foreach($bobot as $k=>$b){
            $w[$k]=$b/$totalBobot;
        }

        
        // Perhitungan Nilai Ultility
        $gabung=[];
        foreach($alternatif as $a=>$v){
            foreach($kriterias as $k=>$v_k){
                if(!isset($gabung[$k]))$gabung[$k]=[];
                if(!isset($sample[$a][$k]))$sample[$a][$k] = 0;
                $gabung[$k][$a]=$sample[$a][$k];
            }
        }
        
        // Mencari Max dan Min tiap-tiap kriteria
        $c_max=[];
        $c_min=[];
        foreach($kriterias as $k=>$v){
            $c_max[$k]=max($gabung[$k]);
            $c_min[$k]=min($gabung[$k]);
        }

        // Simpan Nilai Utility pada variabel Utility
        $utility=[];

        //  Menghitung Utility untuk setiap alternatif dan kriteria
        foreach($kriterias as $k=>$v){
            foreach($alternatif as $a=>$a_v){
                if(!isset($utility[$a])) $utility[$a]=[];
                if($kriterias[$k][2]=='max'){
                    // Kalau Tipe Max (Benefit)
                    if(empty($sample[$a][$k])) {
                        $utility[$a][$k]=0;
                    }else{
                        $utility[$a][$k]=($sample[$a][$k]-$c_min[$k])/($c_max[$k]-$c_min[$k]);
                    }
                }else{
                    // Kalau Tipe Min (Cost)
                    $utility[$a][$k]=($c_max[$k]-$sample[$a][$k])/($c_max[$k]-$c_min[$k]);
                }
            }
        }
        
        // Melakukan Perhitungan Nilai Akhir!
        $nAkhir=[];
        foreach($utility as $a=>$a_u){
            $nAkhir[$a]=0;
            foreach($a_u as $k=>$u){
                $nAkhir[$a]+=$u*$w[$k];
            }
        }

        // PERANGKINGAN!!
        // mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya 
        arsort($nAkhir); 
        $a = array_keys($nAkhir);
        $ids = collect($a);

        $sorted = $ids->map(function($id) use($dataKaryawan) {
            return $dataKaryawan->where('id', $id)->first();
        });
        $arr = array_values($nAkhir);
        foreach ($arr as $a => $val){
            $sorted[$a]->nilai=$val;
        }


        return $sorted;
    }
}
