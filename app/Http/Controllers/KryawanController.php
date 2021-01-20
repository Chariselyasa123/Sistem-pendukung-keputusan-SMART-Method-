<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Nilai;
use App\Data;
use App\Kriteria;
use App\Status;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KryawanController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('karyawan.infokarya');
    }

    public function getKaryawan(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::query();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function habisKontrak()
    {
        $office = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get()->count();
        $intake = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get()->count();
        $warehousing = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->get()->count();
        $produksi = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->get()->count();
        $qclab = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab')->get()->count();
        $ga = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get()->count();
        $truckscale = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get()->count();
        $premix = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix')->get()->count();
        $maintance = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->get()->count();
        $kebersihan = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get()->count();

        return view('karyawan.habiskntrk', compact('office', 'intake', 'warehousing', 'produksi', 'ga', 'premix', 'maintance', 'truckscale', 'kebersihan', 'qclab'));
    }

    public function getHabisKontrakOffice(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakIntake(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakWarehouse(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakProduksi(Request $request)
    {
        if($request->ajax()){
            $data =Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakQclab(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakGa(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakTruckScale(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakPremix(Request $request)
    {
        if($request->ajax()){
            $data =Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakMaintance(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getHabisKontrakKebersihan(Request $request)
    {
        if($request->ajax()){
            $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get();
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function penilaian()
    {
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->get();
        $kepBagOffice = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get();
        $kepBagIntake = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get();
        $kepBagWarehouse = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->get();
        $kepBagProduksi = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->get();
        $kepBagGa = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get();
        $kepBagQclab = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab')->get();
        $kepBagTruck = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get();
        $kepBagPremix = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix')->get();
        $kepBagMaintance = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->get();
        $kepBagKebersihan = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get();
        $checkNullAdmin = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->groupBy('updated_at')->get()->toArray();
        $checkNullOffice = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->groupBy('updated_at')->get()->toArray();
        $checkNullIntake = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->groupBy('updated_at')->get()->toArray();
        $checkNullWarehousing = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->groupBy('updated_at')->get()->toArray();
        $checkNullProduksi = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['produksi', 'hand add'])->groupBy('updated_at')->get()->toArray();
        $checkNullGa = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $checkNullLab = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $checkNullTruck = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $checkNullPremix = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'premix')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $checkNullMaintance = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $checkNullKebersihan = Karyawan::select('karyawans.id', 'karyawans.nama', 'karyawans.berakhir_kontrak', 'status.*')->join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->groupBy('updated_at')->groupBy('updated_at')->get()->toArray();
        $statusAdmin = $karyawan->groupBy('status_admin')->map(function ($people) {
           return $people->count();
        });
        $statusOffice = $kepBagOffice->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusIntake = $kepBagIntake->groupBy('status_kepbag')->map(function ($a) {
           return $a->count();
        });
        $statusWarehousing = $kepBagWarehouse->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusProduksi = $kepBagProduksi->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusGa = $kepBagGa->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusQclab = $kepBagQclab->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusTruck = $kepBagTruck->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusPremix = $kepBagPremix->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusMaintance = $kepBagMaintance->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $statusKebersihan = $kepBagKebersihan->groupBy('status_kepbag')->map(function ($people) {
           return $people->count();
        });
        $isNullAdmin = False;
        $isNullOffice = False;
        $isNullIntake = False;
        $isNullWarehousing = False;
        $isNullProduksi = False;
        $isNullGa = False;
        $isNullLab = False;
        $isNullTruck = False;
        $isNullPremix = False;
        $isNullMaintance = False;
        $isNullKebersihan = False;
        foreach($checkNullAdmin as $c){
            if(in_array(null, $c)){
                $isNullAdmin = True;
            }
        }
        foreach($checkNullOffice as $c){
            if(in_array(null, $c)){
                $isNullOffice = True;
            }
        }
        foreach($checkNullIntake as $c){
            if(in_array(null, $c)){
                $isNullIntake = True;
            }
        }
        foreach($checkNullWarehousing as $c){
            if(in_array(null, $c)){
                $isNullWarehousing = True;
            }
        }
        foreach($checkNullProduksi as $c){
            if(in_array(null, $c)){
                $isNullProduksi = True;
            }
        }
        foreach($checkNullGa as $c){
            if(in_array(null, $c)){
                $isNullGa = True;
            }
        }
        foreach($checkNullLab as $c){
            if(in_array(null, $c)){
                $isNullLab = True;
            }
        }
        foreach($checkNullTruck as $c){
            if(in_array(null, $c)){
                $isNullTruck = True;
            }
        }
        foreach($checkNullPremix as $c){
            if(in_array(null, $c)){
                $isNullPremix = True;
            }
        }
        foreach($checkNullMaintance as $c){
            if(in_array(null, $c)){
                $isNullMaintance = True;
            }
        }
        foreach($checkNullKebersihan as $c){
            if(in_array(null, $c)){
                $isNullKebersihan = True;
            }
        }
        $nowDate = Carbon::now();
        return view('karyawan.penilaian', compact('isNullAdmin', 'isNullOffice', 'isNullIntake', 'isNullWarehousing', 'isNullProduksi', 'isNullGa', 'isNullLab', 'isNullTruck', 'isNullPremix', 'isNullMaintance', 'isNullKebersihan', 'statusKebersihan', 'statusMaintance', 'statusPremix', 'statusTruck', 'statusQclab', 'statusGa', 'statusProduksi', 'statusOffice', 'statusIntake', 'statusWarehousing', 'karyawan', 'nowDate', 'statusAdmin'));
    }

    public function getNilai($id)
    {
        $kehadiran = Kriteria::where('id', 1)->first();
        $motivasi = Kriteria::where('id', 2)->first();
        $komunikasi = Kriteria::where('id', 3)->first();
        $penguasaan = Kriteria::where('id', 4)->first();
        $pAndS = Kriteria::where('id', 5)->first();
        $usia = Kriteria::where('id', 6)->first();
        $nilai = Data::where('karyawan_id', $id)->get()->toArray();
        $karyawan = Karyawan::where('id', $id)->first();
        return view('karyawan.nilai', compact('nilai', 'karyawan', 'kehadiran', 'motivasi', 'komunikasi', 'penguasaan', 'pAndS', 'usia'));
    }
    
    public function getNilaiDetail($id)
    {
        $nilai = Data::where('karyawan_id', $id)->get()->toArray();
        $karyawan = Karyawan::where('id', $id)->first();
        $smartMethod = app(HomeController::class)->smartMethod()->where('id', $id)->first();
        return view('karyawan.nilaiDetail', compact('smartMethod', 'nilai', 'karyawan'));
    }

    public function printNilai($id)
    {
        $nilai = Data::where('karyawan_id', $id)->get()->toArray();
        $karyawan = Karyawan::where('id', $id)->first();
        $smartMethod = app(HomeController::class)->smartMethod()->where('id', $id)->first();
        return view('karyawan.printnilai', compact('smartMethod', 'nilai', 'karyawan'));
    }

    public function getPenilaian()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianOffice()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'office')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianIntake()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'intake')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianwarehousing()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'warehousing')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianProduksi()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['hand add', 'produksi'])->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianGa()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'ga')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianQclab()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'lab')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }


    public function getPenilaianTruck()
    {
        $data = Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianPremix()
    {
        $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['forklifresearch', 'research'])->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianMaintance()
    {
        $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'maintenance')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getPenilaianKebersihan()
    {
        $data = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'kebersihan')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Hapus';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function inputPenilaian(Karyawan $karyawan)
    {
        $kehadiran = Kriteria::where('id', 1)->first();
        $motivasi = Kriteria::where('id', 2)->first();
        $komunikasi = Kriteria::where('id', 3)->first();
        $penguasaan = Kriteria::where('id', 4)->first();
        $pAndS = Kriteria::where('id', 5)->first();
        $usia = Kriteria::where('id', 6)->first();
        return view('karyawan/inputpen', compact('karyawan', 'usia', 'kehadiran', 'pAndS', 'motivasi', 'komunikasi', 'penguasaan'));
    }

    public function storePenilaian(Request $request)
    {
        if($request->get('kehadiran')){
            $request->validate([
                'kehadiran' => 'required|numeric',
                'pAndS' => 'required'
            ],[],[
                'kehadiran' => 'Kehadiran',
                'pAndS' => 'Penilaian dan Sanksi'
            ]);
            $kehadiran = 100;
            if($request->kehadiran == 0){
                $kehadiran;
            }elseif($request->kehadiran > 0 && $request->kehadiran <= 3){
                $kehadiran = 75;
            }elseif($request->kehadiran >= 4 && $request->kehadiran <= 6){
                $kehadiran = 50;
            }elseif($request->kehadiran >= 7 && $request->kehadiran <= 10){
                $kehadiran = 25;
            }elseif($request->kehadiran > 10){
                $kehadiran = 0;
            }
            $data = [
                [
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->usia_id, 
                    'nilai' => $request->nilaiUmur,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],[
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->pAndS_id, 
                    'nilai' => $request->pAndS,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],[
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->kehadiran_id, 
                    'nilai' => $kehadiran,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ];
    
            Data::insert($data);
            Status::where('id', $request->karyawan_id)->update(['status_admin' => 1]);
        }elseif ($request->get('motivasi') || $request->get('komunikasi') || $request->get('penguasaan') || !$request->get('motivasi')) {
            $request->validate([
                'motivasi' => 'required',
                'komunikasi' => 'required',
                'penguasaan' => 'required'
            ],[],[
                'motivasi' => 'Motivasi Kerja',
                'komunikasi' => 'Komunikasi dan Tanggung jawab',
                'penguasaan' => 'Penguasaan pekerjaan'
            ]);

            $data = [
                [
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->motivasi_id, 
                    'nilai' => $request->motivasi,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],[
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->komunikasi_id, 
                    'nilai' => $request->komunikasi,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],[
                    'karyawan_id' => $request->karyawan_id, 
                    'kriteria_id' => $request->penguasaan_id, 
                    'nilai' => $request->penguasaan,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ];

            Data::insert($data);
            Status::where('id', $request->karyawan_id)->update(['status_kepbag' => 1]);
        }
        return redirect('/penilaian')->with('status', "Karyawan bernama $request->nama telah dinilai!");
    }
    
    public function putusKontrak(Karyawan $karyawan)
    {
        return view('karyawan.putuskontrak', compact('karyawan'));
    }

    public function getPutusKontrak(){
        $data = Karyawan::where('ket', 'putus')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = 'Nilai';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.inputkarya');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_induk_karyawan' => 'required|numeric',
            'bagian' => 'required',
            'departemen' => 'required',
            'tanggal_masuk' => 'required|date',
            'berakhir_kontrak' => 'required|date',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'departemen' => 'required',
            'ibu_kandung' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'pendidikan_terakhir' => 'required',
            'status_perkawinan' => 'required',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
        ]);

        $karyawan = Karyawan::create($request->all());
        $status = Status::create([
            'karyawan_id' => $karyawan->id
        ]);
        return redirect('/info_karyawan')->with('status', 'Data Karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Karyawan $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        $nowDate = Carbon::now();
        return view('karyawan.detail', compact('karyawan', 'nowDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Karyawan $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'nik_ktp' => 'required',
            'no_induk_karyawan' => 'required',
            'bagian' => 'required',
            'ibu_kandung' => 'required',
            'kewarganegaraan' => 'required',
            'no_jamsostek' => 'required',
            'no_rek' => 'required'
        ]);
        
        Karyawan::where('id', $karyawan->id)->update([
            'nama' => $request->nama,
            'no_induk_karyawan' => $request->no_induk_karyawan,
            'bagian' => $request->bagian,
            'tanggal_masuk' => $request->tanggal_masuk,
            'berakhir_kontrak' => $request->berakhir_kontrak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'departemen' => $request->departemen,
            'ibu_kandung' => $request->ibu_kandung,
            'alamat' => $request->alamat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'kewarganegaraan' => $request->kewarganegaraan,
            'status_perkawinan' => $request->status_perkawinan,
            'agama' => $request->agama,
        ]);
        return redirect("/info_karyawan/$karyawan->id")->with('status', 'Data Karyawan Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Nilai $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nilai::where('karyawan_id', $id)->delete();
        Karyawan::where('id', $id)->update(['status' => 0]);

        return redirect("/penilaian")->with('status', 'Nilai Karyawan Berhasil Dihapus!');
    }

    public function printHbsKntrk($departemen)
    {
        $dataTruck = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', 'truck scale')->get();
        $dataProduksi = Karyawan::whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->whereIn('departemen', ['hand add', 'produksi'])->get();
        $data =Karyawan::join('status', 'karyawans.id', 'status.karyawan_id')->whereMonth('berakhir_kontrak', Carbon::now()->month)->whereYear('berakhir_kontrak', Carbon::now()->year)->where('departemen', $departemen)->get();
        $out = DB::select("select min(id) as maxKode FROM karyawans WHERE month(`berakhir_kontrak`)=month(now()) AND year(`berakhir_kontrak`)=year(now())");
        return view('karyawan.printhabis', compact('data', 'out', 'departemen', 'dataProduksi', 'dataTruck'));
    }

    public function uploadFoto(Request $request, Karyawan $karyawan)
    {
        $this->validate($request, [
			'file' => 'required'
        ]);
        
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $dirFoto = 'dist/img/karyawan';

        $file->move($dirFoto, $nama_file);

        Karyawan::where('id', $karyawan->id)->update(['foto' => $nama_file]);

        return redirect()->back()->with('status', 'Foto Karyawan Berhasil Diupdate!');
    }
}
