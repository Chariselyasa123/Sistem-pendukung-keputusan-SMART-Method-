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

    private function time(String $dep = null, String $by)
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

    private function totalTerima($nilaiAkhir)
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

    private function totalTolak($nilaiAkhir)
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

    public function getkaryawanHbsKntrkBlnDpn(Request $request)
    {
        return $this->getData($request, 'karyawan');
    }

    public function dataNilaiBlnIni(Request $request)
    {
        switch ($request->get('dep')) {
            case 'admin':
                return Datatables::of($this->smartMethod($request->get('bulan')))->addIndexColumn()->make(true);
            case 'office':
                return Datatables::of($this->smartMethod('office'))->addIndexColumn()->make(true);
            case 'intake':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Intake");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'warehousing':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("warehousing");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'produksi':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $hand = $nilaiAkhir->groupBy('departemen')->get("hand add");
                $prod = $nilaiAkhir->groupBy('departemen')->get("Produksi");
                $data = $hand->merge($prod);
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'ga':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("GA");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'lab':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Lab");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'truck':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Truck Scale");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'premix':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Premix");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'maintenance':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Maintenance");
                return Datatables::of($data)->addIndexColumn()->make(true);
            case 'kebersihan':
                $nilaiAkhir = $this->smartMethod($request->get('bulan'));
                $data = $nilaiAkhir->groupBy('departemen')->get("Kebersihan");
                return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }
}
