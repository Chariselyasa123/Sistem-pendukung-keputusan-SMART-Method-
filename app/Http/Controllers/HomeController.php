<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Kriteria;
use App\Data;
use App\Status;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Karyawan $karya, Request $request)
    {
        // dump($request->get('filterBulan'));
        // Session::put('bulan', $request->get('filterBulan'));
        $office = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get()->count();
        $officeSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->where('status', 1)->get()->count();
        $officeBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->where('status', 0)->get()->count();
        $intake = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get()->count();
        $intakeSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->where('status', 1)->get()->count();
        $intakeBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->where('status', 0)->get()->count();
        $warehouse = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehouse')->get()->count();
        $warehouseSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehouse')->where('status', 1)->get()->count();
        $warehouseBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehouse')->where('status', 0)->get()->count();
        $produksi = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->get()->count();
        $produksiSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->where('status', 1)->get()->count();
        $produksiBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->where('status', 0)->get()->count();
        $qclab = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'qclab')->get()->count();
        $qclabSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'qclab')->where('status', 1)->get()->count();
        $qclabBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'qclab')->where('status', 0)->get()->count();
        $ga = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get()->count();
        $gaSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->where('status', 1)->get()->count();
        $gaBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->where('status', 0)->get()->count();
        $truckscale = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truckscale')->get()->count();
        $truckscaleSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truckscale')->where('status', 1)->get()->count();
        $truckscaleBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truckscale')->where('status', 0)->get()->count();
        $premix = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['research', 'forklifresearch'])->get()->count();
        $premixSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['research', 'forklifresearch'])->where('status', 1)->get()->count();
        $premixBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['research', 'forklifresearch'])->where('status', 0)->get()->count();
        $maintance = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintance')->get()->count();
        $maintanceSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'meintenance')->where('status', 1)->get()->count();
        $maintanceBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->where('status', 0)->get()->count();
        $kebersihan = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get()->count();
        $kebersihanSdhNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->where('status', 1)->get()->count();
        $kebersihanBlmNli = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->where('status', 0)->get()->count();
        $berakhirKontrak = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->get()->count();
        $berakhirKontrakBlnDpn = Karyawan::whereBetween('berakhir_kontrak', [Carbon::now(), Carbon::now()->addDays(30)])->get()->count();
        $sudahNilai = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('status', 1)->get()->count();
        $belumNilai = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('status', 0)->get()->count();
        $karyawan = Karyawan::all()->count();

        $ontimeAdmin = $this->time(null, '<=');
        $ontimeIntake = $this->time('Intake', '<=');
        $ontimeWarehousing = $this->time(null, '<=');
        $handAdd = $this->time('hand add', '<=');
        $produksi = $this->time('Produksi', '<=');
        $ontimeProduksi = $handAdd + $produksi;
        $ontimeGa = $this->time('GA', '<=');
        $ontimeLab = $this->time('Lab', '<=');
        $ontimeTruck = $this->time('Truck Scale', '<=');
        $ontimePremix = $this->time('Premix', '<=');
        $ontimeMaintance = $this->time('Maintenance', '<=');
        $ontimeKebersihan = $this->time('Kebersihan', '<=');

        $overdueAdmin = $this->time(null, '>=');
        $overdueIntake = $this->time('Intake', '>=');
        $overdueWarehousing = $this->time(null, '>=');
        $handAdd = $this->time('hand add', '>=');
        $produksi = $this->time('Produksi', '>=');
        $overdueProduksi = $handAdd + $produksi;
        $overdueGa = $this->time('GA', '>=');
        $overdueLab = $this->time('Lab', '>=');
        $overdueTruck = $this->time('Truck Scale', '>=');
        $overduePremix = $this->time('Premix', '>=');
        $overdueMaintance = $this->time('Maintenance', '>=');
        $overdueKebersihan = $this->time('Kebersihan', '>=');
        
        $nilaiAkhir = $this->smartMethod();
        $nilaiAkhirIntake = $nilaiAkhir->groupBy('departemen')->get("Intake");
        $nilaiAkhirWarehousing = $nilaiAkhir->groupBy('departemen')->get("warehousing");
        $hand = $nilaiAkhir->groupBy('departemen')->get("hand add");
        $prod = $nilaiAkhir->groupBy('departemen')->get("Produksi");
        $merge = $hand->merge($prod);
        $nilaiAkhirProduksi = $merge->sortBy('nilai')->values();
        $nilaiAkhirGA = $nilaiAkhir->groupBy('departemen')->get("GA");
        $nilaiAkhirLab = $nilaiAkhir->groupBy('departemen')->get("Lab");
        $nilaiAkhirTruck = $nilaiAkhir->groupBy('departemen')->get("Truck Scale");
        $nilaiAkhirPremix = $nilaiAkhir->groupBy('departemen')->get("Premix");
        $nilaiAkhirMaintance = $nilaiAkhir->groupBy('departemen')->get("Maintenance");
        $nilaiAkhirKebersihan= $nilaiAkhir->groupBy('departemen')->get("Kebersihan");
        
        $terimaAdmin = $this->totalTerima($nilaiAkhir);
        $terimaIntake = $this->totalTerima($nilaiAkhirIntake);
        $terimaWarehousing = $this->totalTerima($nilaiAkhirWarehousing);
        $terimaProduksi = $this->totalTerima($nilaiAkhirProduksi);
        $terimaGa = $this->totalTerima($nilaiAkhirGA);
        $terimaLab = $this->totalTerima($nilaiAkhirLab);
        $terimaTruck = $this->totalTerima($nilaiAkhirTruck);
        $terimaPremix = $this->totalTerima($nilaiAkhirPremix);
        $terimaMaintance = $this->totalTerima($nilaiAkhirMaintance);
        $terimaKebersihan = $this->totalTerima($nilaiAkhirKebersihan);
        
        $tolakAdmin = $this->totalTolak($nilaiAkhir);
        $tolakIntake = $this->totalTolak($nilaiAkhirIntake);
        $tolakWarehousing = $this->totalTolak($nilaiAkhirWarehousing);
        $tolakProduksi = $this->totalTolak($nilaiAkhirProduksi);
        $tolakGa = $this->totalTolak($nilaiAkhirGA);
        $tolakLab = $this->totalTolak($nilaiAkhirLab);
        $tolakTruck = $this->totalTolak($nilaiAkhirTruck);
        $tolakPremix = $this->totalTolak($nilaiAkhirPremix);
        $tolakMaintance = $this->totalTolak($nilaiAkhirMaintance);
        $tolakKebersihan = $this->totalTolak($nilaiAkhirKebersihan);

        return view('karyawan.home', compact('overdueAdmin', 'overdueIntake', 'overdueWarehousing', 'overdueProduksi', 'overdueGa', 'overdueLab', 'overdueTruck', 'overduePremix', 'overdueMaintance', 'overdueKebersihan', 'ontimeAdmin', 'ontimeIntake', 'ontimeWarehousing', 'ontimeProduksi', 'ontimeGa', 'ontimeLab', 'ontimeTruck', 'ontimePremix', 'ontimeMaintance', 'ontimeKebersihan', 'tolakAdmin', 'tolakIntake', 'tolakWarehousing', 'tolakProduksi', 'tolakGa', 'tolakLab', 'tolakTruck', 'tolakPremix', 'tolakMaintance', 'tolakKebersihan', 'terimaAdmin', 'terimaIntake', 'terimaWarehousing', 'terimaProduksi', 'terimaGa', 'terimaLab', 'terimaTruck', 'terimaPremix', 'terimaMaintance', 'terimaKebersihan', 'belumNilai', 'karya', 'berakhirKontrakBlnDpn', 'sudahNilai', 'berakhirKontrak', 'office', 'officeSdhNli', 'officeBlmNli', 'intake', 'intakeSdhNli', 'intakeBlmNli', 'warehouse', 'warehouseSdhNli', 'warehouseBlmNli', 'produksi', 'produksiSdhNli', 'produksiBlmNli', 'ga', 'gaSdhNli', 'gaBlmNli', 'premix', 'premixSdhNli', 'premixBlmNli', 'maintance', 'maintanceSdhNli', 'maintanceBlmNli', 'truckscale', 'truckscaleSdhNli', 'truckscaleBlmNli', 'kebersihan', 'kebersihanSdhNli', 'kebersihanBlmNli', 'qclab', 'qclabSdhNli', 'qclabBlmNli', 'karyawan'));
    }

    function time(String $dep = null, String $by)
    {
        $time = Status::where('created_at', $by, Carbon::now()->endOfMonth()->addDays(-14))->get();
        $i = [];
        foreach($time as $o => $v){
            if(!empty($dep)) {
                if($v->karyawan->departemen == $dep) $i[$o] = $v;
            }else{
                if($v->karyawan->departemen) $i[$o] = $v;
            }
        }
        return count($i);
    }

    function totalTerima($nilaiAkhir)
    {
        if(!empty($nilaiAkhir)){
            $arr = [];
            foreach ($nilaiAkhir as $na => $val){
                $nilai = number_format($val->nilai, 2, '.', '');
                $arr[$na] = $nilai*100;
            }
            $terima = array_filter($arr, function($val){
                return $val >= 60;
            });
    
            return count($terima);
        }
        return null;
    }

    function totalTolak($nilaiAkhir)
    {
        if(!empty($nilaiAkhir)){
            $arr = [];
            foreach ($nilaiAkhir as $na => $val){
                $nilai = number_format($val->nilai, 2, '.', '');
                $arr[$na] = $nilai*100;
            }
            $tolak = array_filter($arr, function($val){
                return $val < 60;
            });

            return count($tolak);
        }
        return null;

    }

    public function smartMethod(){
        // Memanggil data penilaian dari tabel data
        $nilai = Data::orderBy('karyawan_id', 'asc')->orderBy('kriteria_id', 'asc')->get();
        // Memanggil alternatif (Karyawan Habis Kontrak)
        $dataKaryawan = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->get();
        // Manggil Bobot
        $kriteria = Kriteria::get();

        // Pengambilan Nilai Kriteria
        $kriterias = array();
        foreach ($kriteria as $k){
            $kriterias[$k->id]=array($k->kriteria,$k->bobot,$k->tipe);
        }
        // Pengambilan Nilai Penilaian
        $sample = array();
        foreach ($nilai as $n) {
            $sample[$n->karyawan_id][$n->kriteria_id]=$n->nilai;
        }

        $zero = Karyawan::select('id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereNotIn('id', function($query){
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
        $alternatif = array();
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
        $w=array();
        // Normalisasi bobot
        foreach($bobot as $k=>$b){
            $w[$k]=$b/$totalBobot;
        }

        // Perhitungan Nilai Ultility
        $gabung=array();
        foreach($alternatif as $a=>$v){
            foreach($kriterias as $k=>$v_k){
                if(!isset($gabung[$k]))$gabung[$k]=array();
                $gabung[$k][$a]=$sample[$a][$k];
            }
        }
        
        // Mencari Max dan Min tiap-tiap kriteria
        $c_max=array();
        $c_min=array();
        foreach($kriterias as $k=>$v){
            $c_max[$k]=max($gabung[$k]);
            $c_min[$k]=min($gabung[$k]);
        }

        // Simpan Nilai Utility pada variabel Utility
        $utility=array();

        //  Menghitung Utility untuk setiap alternatif dan kriteria
        foreach($kriterias as $k=>$v){
            foreach($alternatif as $a=>$a_v){
                if(!isset($utility[$a])) $utility[$a]=array();
                if($kriterias[$k][2]=='max'){
                    // Kalau Tipe Max (Benefit)
                    $utility[$a][$k]=($sample[$a][$k]-$c_min[$k])/($c_max[$k]-$c_min[$k]);
                }else{
                    // Kalau Tipe Min (Cost)
                    $utility[$a][$k]=($c_max[$k]-$sample[$a][$k])/($c_max[$k]-$c_min[$k]);
                }
            }
        }
        
        // Melakukan Perhitungan Nilai Akhir!
        $nAkhir=array();
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

    public function getkaryawanHbsKntrkBlnIni(Request $request)
    {
        if($request->ajax()){
            return Datatables::of($this->smartMethod())->addIndexColumn()->make(true);
        }
    }

    public function getkaryawanHbsKntrkBlnDpn(Request $request)
    {
        if($request->get('dep') == 'admin'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'));
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year);
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'produksi'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->whereIn('departemen', ['produksi', 'hand add']);
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add']);
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'intake'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'intake');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'warehousing'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'warehousing');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'ga'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'ga');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'lab'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'lab');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'truck'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'truck scale');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'premix'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'premix');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'maintenance'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'maintenance');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance');
                }
            })->make(true);
        }
        elseif($request->get('dep') == 'kebersihan'){
            $data = Karyawan::select('*');
            return Datatables::of($data)->addIndexColumn()->filter(function ($query) use ($request){
                if(!empty($request->get('bulan'))){
                    $query->whereMonth('berakhir_kontrak', $request->get('bulan'))->where('departemen', 'kebersihan');
                }else{
                    $query->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan');
                }
            })->make(true);
        }
    }

    public function getKaryawanOffice(Request $request)
    {
        if($request->ajax()){
            return Datatables::of($this->smartMethod('office'))->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanIntake(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Intake");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanWarehouse(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("warehousing");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanProduksi(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $hand = $nilaiAkhir->groupBy('departemen')->get("hand add");
            $prod = $nilaiAkhir->groupBy('departemen')->get("Produksi");
            $data = $hand->merge($prod);
            return Datatables::of($data->sortByDesc('nilai')->values())->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanQclab(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Lab");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanTruck(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Truck Scale");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanGa(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("GA");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanPremix(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Premix");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }
    
    public function getKaryawanMaintance(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Maintenance");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getKaryawanKebersihan(Request $request)
    {
        if($request->ajax()){
            $nilaiAkhir = $this->smartMethod();
            $data = $nilaiAkhir->groupBy('departemen')->get("Kebersihan");
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }
}
