@extends('layouts.main')

@section('title', 'Dashboard')

@push('style')
<style>
    #scrollUp {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
    }

    #load{
        width:100%;
        height:100%;
        position:fixed;
        z-index:9999;
        background:url("{{ asset('dist/img/loading.gif') }}") no-repeat rgba(244,246,249);
        background-position: 40% 40%;
    }
</style>
@endpush

@role('admin')
@section('content')
<div id="load"></div>
<div class="container mt-3" id="contents" style="display: none">
    <div class="row">
        <div class="col-md-4">
            <!-- Total karyawan -->
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Total Karyawan</h3>
                </div>
                <div class="card-body">
                    <canvas id="karyawanChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 100%;"></canvas>
                    <hr class="m-1">
                    <p class="mb-1">Total karyawan <span class="float-right badge badge-success" style="background-color: #4bc0c0">{{ $karyawan }}</span></p>
                    <hr class="m-1">
                    <p class="mb-1">Habis Kontrak <span class="float-right badge badge-success" style="background-color: #ffcd56">{{ $berakhirKontrak }}</span></p>
                    <hr class="m-1"> 
                    <p class="mb-1">Sisa karyawan <span class="float-right badge badge-success" style="background-color: #ff6384">{{ $karyawan-$berakhirKontrak }}</span></p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <!-- Penilaian -->
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Nilai</h3>
                </div>
                <div class="card-body">
                    <canvas id="penilaianChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 100%;"></canvas>
                    <hr class="m-1">
                    <p class="mb-1">Total Harus Nilai <span class="float-right badge badge-info" style="background-color: #00c0ef">{{ $belumNilai }}</span></p>
                    <hr class="m-1">
                    <p class="mb-1">On Time <span class="float-right badge badge-info" style="background-color: #3c8dbc">{{ $sudahNilai }}</span></p>
                    <hr class="m-1"> 
                    <p class="mb-1">Overdue<span class="float-right badge badge-info" style="background-color: #7659ba">{{ $berakhirKontrak-$sudahNilai }}</span></p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <!-- Rekomendasi -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rekomedasi</h3>
                </div>
                <div class="card-body">
                    <canvas id="rekomendasiChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 100%;"></canvas>
                    <hr class="m-1">
                    <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $berakhirKontrak }}</span></p>
                    <hr class="m-1">
                    <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaAdmin }}</span></p>
                    <hr class="m-1"> 
                    <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakAdmin }}</span></p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-table"></i> Rekomendasi Karyawan Habis Kontrak Bulan <span id="bulan">{{ date('F') }}</span></h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="habisKntrkBlnIni" style="font-size: 0.875em;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Departemen</th>
                        <th>Berakhir Kontrak</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="row mt-3 ml-1">
                <span class="badge badge-pill badge-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <i>&nbsp;Rekomendasi perpanjang kontrak</i>
            </div>
            <div class="row mt-1 ml-1">
                <span class="badge badge-pill badge-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <i>&nbsp;Tidak direkomendasikan</i>
            </div>
        </div>
    </div>
    <div class="form-group col-md-4 pl-0">
        <select name="filterBulan" id="filterBulan" class="custom-select">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat <strong id="karyawan"></strong> karyawan yang akan habis kontraknya Bulan <span class="bulan">{{ date('F') }}</span>!</p>
    </div>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-table"></i> List Karyawan Habis Kontrak Bulan <span class="bulan">{{ date('F') }}</span></h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="habisKntrkBlnDpn" style="font-size: 0.875em;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Departemen</th>
                        <th>Tanggal Masuk</th>
                        <th>Berakhir Kontrak</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="umur" value="{{ $karya->umur }}">
<button class="btn btn-info" id="scrollUp" onclick="topFunction()" data-toggle="toolip" title="Back To Top"><i class="fas fa-chevron-up"></i></button>
@endsection
@else
@section('content')
<div id="load"></div>
<div class="container mt-3" id="contents" style="display: none">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <!-- Rekomendasi -->
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rekomedasi</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="rekomendasiChart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 100%;"></canvas>
                        <hr class="m-1">
                        @role('intake')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $intake }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaIntake }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakIntake }}</span></p>
                        @elserole('warehouse')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $warehouse }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaWarehousing }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakWarehousing }}</span></p>
                        @elserole('produksi')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $produksi }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaProduksi }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakProduksi }}</span></p>
                        @elserole('ga')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $ga }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaGa }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakGa }}</span></p>
                        @elserole('lab')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $qclab }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaLab}}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakLab}}</span></p>
                        @elserole('truck')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $truckscle }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaTruck}}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakTruck}}</span></p>
                        @elserole('premix')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $premix }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaPremix }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakPremix }}</span></p>
                        @elserole('maintance')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $maintance }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaMaintance }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakMaintance }}</span></p>
                        @elserole('kebersihan')
                        <p class="mb-1">Habis Kontrak <span class="float-right badge badge-info" style="background-color: #293453">{{ $kebersihan }}</span></p>
                        <hr class="m-1">
                        <p class="mb-1">Direkomendasikan <span class="float-right badge badge-info" style="background-color: #6ed57e">{{ $terimaKebersihan }}</span></p>
                        <hr class="m-1"> 
                        <p class="mb-1">Tidak Direkomendasikan <span class="float-right badge badge-info" style="background-color: #ffd55b">{{ $tolakKebersihan }}</span></p>
                        @endrole
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
            <div class="col">
                <div class="info-box" style="margin-bottom: 3.5rem">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Karyawan</span>
                    <span class="info-box-number">{{ $karyawan }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box" style="margin-bottom: 3.5rem">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-pen-square"></i></span>

                <div class="info-box-content" >
                    <span class="info-box-text">Belum Nilai</span>
                    @role('office')
                    <span class="info-box-number">{{ $officeBlmNli }}</span>
                    @elserole('intake')
                    <span class="info-box-number">{{ $intakeBlmNli }}</span>
                    @elserole('warehouse')
                    <span class="info-box-number">{{ $warehouseBlmNli }}</span>
                    @elserole('produksi')
                    <span class="info-box-number">{{ $produksiBlmNli }}</span>
                    @elserole('qclab')
                    <span class="info-box-number">{{ $qclabBlmNli }}</span>
                    @elserole('ga')
                    <span class="info-box-number">{{ $gaBlmNli }}</span>
                    @elserole('truck')
                    <span class="info-box-number">{{ $truckscaleBlmNli }}</span>
                    @elserole('premix')
                    <span class="info-box-number">{{ $premixBlmNli }}</span>
                    @elserole('maintance')
                    <span class="info-box-number">{{ $maintanceBlmNli }}</span>
                    @elserole('kebersihan')
                    <span class="info-box-number">{{ $kebersihanBlmNli }}</span>
                    @endrole
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!-- /.info- On Time -->
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">On TIme</span>
                    @role('office')
                    <span class="info-box-number">0</span>
                    @elserole('intake')
                    <span class="info-box-number">{{ $ontimeIntake }}</span>
                    @elserole('warehouse')
                    <span class="info-box-number">{{ $ontimeWarehousing }}</span>
                    @elserole('produksi')
                    <span class="info-box-number">{{ $ontimeProduksi }}</span>
                    @elserole('qclab')
                    <span class="info-box-number">{{ $ontimeLab }}</span>
                    @elserole('ga')
                    <span class="info-box-number">{{ $ontimeGa}}</span>
                    @elserole('truck')
                    <span class="info-box-number">{{ $ontimeTruck }}</span>
                    @elserole('premix')
                    <span class="info-box-number">{{ $ontimePremix }}</span>
                    @elserole('maintance')
                    <span class="info-box-number">{{ $ontimeMaintance }}</span>
                    @elserole('kebersihan')
                    <span class="info-box-number">{{ $ontimeKebersihan }}</span>
                    @endrole
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col">
                <div class="info-box" style="margin-bottom: 3.5rem">
                <span class="info-box-icon bg-gray elevation-1"><i class="fas fa-file-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Habis Kontrak</span>
                    @role('office')
                    <span class="info-box-number">{{ $office }}</span>
                    @elserole('intake')
                    <span class="info-box-number">{{ $intake }}</span>
                    @elserole('warehouse')
                    <span class="info-box-number">{{ $warehouse }}</span>
                    @elserole('produksi')
                    <span class="info-box-number">{{ $produksi }}</span>
                    @elserole('qclab')
                    <span class="info-box-number">{{ $qclab }}</span>
                    @elserole('ga')
                    <span class="info-box-number">{{ $ga }}</span>
                    @elserole('truck')
                    <span class="info-box-number">{{ $truckscale }}</span>
                    @elserole('premix')
                    <span class="info-box-number">{{ $premix }}</span>
                    @elserole('maintance')
                    <span class="info-box-number">{{ $maintance }}</span>
                    @elserole('kebersihan')
                    <span class="info-box-number">{{ $kebersihan }}</span>
                    @endrole
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box" style="margin-bottom: 3.5rem">
                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-pen-square"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sudah Nilai</span>
                    @role('office')
                    <span class="info-box-number">{{ $officeSdhNli }}</span>
                    @elserole('intake')
                    <span class="info-box-number">{{ $intakeSdhNli }}</span>
                    @elserole('warehouse')
                    <span class="info-box-number">{{ $warehouseSdhNli }}</span>
                    @elserole('produksi')
                    <span class="info-box-number">{{ $produksiSdhNli }}</span>
                    @elserole('qclab')
                    <span class="info-box-number">{{ $qclabSdhNli }}</span>
                    @elserole('ga')
                    <span class="info-box-number">{{ $gaSdhNli }}</span>
                    @elserole('truck')
                    <span class="info-box-number">{{ $truckscaleSdhNli }}</span>
                    @elserole('premix')
                    <span class="info-box-number">{{ $premixSdhNli }}</span>
                    @elserole('maintance')
                    <span class="info-box-number">{{ $maintanceSdhNli }}</span>
                    @elserole('kebersihan')
                    <span class="info-box-number">{{ $kebersihanSdhNli }}</span>
                    @endrole
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!-- /.info-Overdue-->
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Overdue</span>
                    @role('office')
                    <span class="info-box-number">0</span>
                    @elserole('intake')
                    <span class="info-box-number">{{ $overdueIntake }}</span>
                    @elserole('warehouse')
                    <span class="info-box-number">{{ $overdueWarehousing }}</span>
                    @elserole('produksi')
                    <span class="info-box-number">{{ $overdueProduksi }}</span>
                    @elserole('qclab')
                    <span class="info-box-number">{{ $overdueLab }}</span>
                    @elserole('ga')
                    <span class="info-box-number">{{ $overdueGa}}</span>
                    @elserole('truck')
                    <span class="info-box-number">{{ $overdueTruck }}</span>
                    @elserole('premix')
                    <span class="info-box-number">{{ $overduePremix }}</span>
                    @elserole('maintance')
                    <span class="info-box-number">{{ $overdueMaintance }}</span>
                    @elserole('kebersihan')
                    <span class="info-box-number">{{ $overdueKebersihan }}</span>
                    @endrole
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat @role('office')
                <span class="info-box-number"><strong>{{ $office }}</strong></span>
                @elserole('intake')
                <span class="info-box-number"><strong>{{ $intake }}</strong></span>
                @elserole('warehouse')
                <span class="info-box-number"><strong>{{ $warehouse }}</strong></span>
                @elserole('produksi')
                <span class="info-box-number"><strong>{{ $produksi }}</strong></span>
                @elserole('qclab')
                <span class="info-box-number"><strong>{{ $qclab }}</strong></span>
                @elserole('ga')
                <span class="info-box-number"><strong>{{ $ga }}</strong></span>
                @elserole('truck')
                <span class="info-box-number"><strong>{{ $truckscale }}</strong></span>
                @elserole('premix')
                <span class="info-box-number"><strong>{{ $premix }}</strong></span>
                @elserole('maintance')
                <span class="info-box-number"><strong>{{ $maintance }}</strong></span>
                @elserole('kebersihan')
                <span class="info-box-number"><strong>{{ $kebersihan }}</strong></span>
                @endrole karyawan yang akan habis kontraknya pada bulan ini!</p>
        </div>
        <div class="card card-primary card-tabs card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-table"></i> List Karyawan Habis Kontrak Bulan  <span id="bulan2">{{ date('F') }}</span></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="habisKntrk" style="font-size: 0.875em;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Induk Karyawan</th>
                            <th>Nama</th>
                            <th>Bagian</th>
                            <th>departemen</th>
                            <th>Berakhir Kontrak</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group col-md-4 pl-0">
        <select name="filterBulan" id="filterBulan" class="custom-select">
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat <strong id="karyawan"></strong> karyawan yang akan habis kontraknya Bulan <span class="bulan">{{ date('F') }}</span>!</p>
    </div>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-table"></i> List Karyawan Habis Kontrak Bulan <span class="bulan">{{ date('F') }}</span></h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="filterHbsKntrk" style="font-size: 0.875em;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Departemen</th>
                        <th>Tanggal Masuk</th>
                        <th>Berakhir Kontrak</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<button class="btn btn-info" id="scrollUp" onclick="topFunction()" data-toggle="toolip" title="Back To Top"><i class="fas fa-chevron-up"></i></button>
@endsection
@endrole

@role('office')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.off') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })
})
</script>
@endpush
@elserole('intake')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.int') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'intake'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $intake }}", "{{ $terimaIntake }}", "{{ $tolakIntake }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('warehouse')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.war') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'warehousing'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $warehouse }}", "{{ $terimaWarehousing }}", "{{ $tolakWarehousing }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('produksi')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.prod') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })

    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'produksi'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})

var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $produksi }}", "{{ $terimaProduksi }}", "{{ $tolakProduksi }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('qclab')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.qc') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'lab'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
    
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $qclab }}", "{{ $terimaLab }}", "{{ $tolakLab }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('ga')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.ga') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'ga'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $ga }}", "{{ $terimaGa }}", "{{ $tolakGa }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('truck')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.truck') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'truck'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $truckscale }}", "{{ $terimaTruck }}", "{{ $tolakTruck }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('premix')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.pre') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'premix'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $premix }}", "{{ $terimaPremix }}", "{{ $tolakPremix }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('maintance')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.main') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'maintenance'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $maintance }}", "{{ $terimaMaintance }}", "{{ $tolakMaintance }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush
@elserole('kebersihan')
@push('info-karyawan')
<script>
$(function(){
    var table = $('#habisKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.keb') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
            {data: 'nilai', name: 'nilai', 
            "render" : function (nTd, sData, oData, iRow, iCol) {
                var n = oData.nilai.toFixed(2)
                var y = n*100
                if(y >= 60 && y <= 100){
                    return `<span class="badge badge-pill badge-success">${y}%</span>`
                }else if(y <= 59){
                    return `<span class="badge badge-pill badge-danger">${y}%</span>`
                }
            }},
        ]
    })
    var filter = $('#filterHbsKntrk').DataTable({
        responsive:true,
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('dashboard.dpn') }}",
            data: d => {
                d.bulan = $('#filterBulan').val(),
                d.dep = 'kebersihan'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
            {data: 'nama', name: 'nama', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
            }}, 
            {data: 'bagian', name: 'bagian'},
            {data: 'departemen', name: 'departemen'},
            {data: 'tanggal_masuk', name: 'tanggal_masuk'},
            {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
        ]
    })

    const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $('#filterBulan').change(function(){
        filter.draw();
        $('.bulan').text(bulan[$(this).val()])
    });
    $('#filterHbsKntrk').on('draw.dt', function() {
        $('#karyawan').text(filter.ajax.json().recordsFiltered)
    });
})
var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
var rekomendasiChartData        = {
    labels: [
        'Habis Kontrak',
        'Direkomendasikan',
        'Tidak Direkomendasikan' 
    ],
    datasets: [
        {
            data: ["{{ $kebersihan }}", "{{ $terimaKebersihan }}", "{{ $tolakKebersihan }}"],
            backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
        }
    ]
}

var rekomendasiChartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend:{
        display: false,
        position: 'right',
        align: 'start',
        labels:{
            generateLabels: function(chart) {
                var data = chart.data;
                if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, i) {
                        var meta = chart.getDatasetMeta(0);
                        var ds = data.datasets[0];
                        var arc = meta.data[i];
                        var custom = arc && arc.custom || {};
                        var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                        var arcOpts = chart.options.elements.arc;
                        var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                        var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                        var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                        var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                        return {
                            text: label + " : " + value,
                            fillStyle: fill,
                            strokeStyle: stroke,
                            lineWidth: bw,
                            hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                            index: i
                        };
                    });
                } else {
                    return [];
                }
            }
        }
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                var total = meta.total;
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                return currentValue + ' (' + percentage + '%)';
            },
            title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
            }
        }
    }
}

var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
    type: 'doughnut',
    data: rekomendasiChartData,
    options: rekomendasiChartOptions    
})
</script>
@endpush

@elserole('admin')

@push('info-karyawan')
<script>
    $(function(){
        var karyawanChartCanvas = $('#karyawanChart').get(0).getContext('2d')
        var karyawanChartData        = {
            labels: [
                'Total Karyawan',
                'Habis Kontrak',
                'Sisa Karyawan' 
            ],
            datasets: [
                {
                    data: ["{{ $karyawan }}", "{{ $berakhirKontrak }}", "{{ $karyawan-$berakhirKontrak }}"],
                    backgroundColor : ['#ff6384', '#ffcd56', '#4bc0c0'],
                }
            ]
        }

        var karyawanChartOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            legend:{
                display: false,
                position: 'right',
                align: 'start',
                labels:{
                    generateLabels: function(chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function(label, i) {
                                var meta = chart.getDatasetMeta(0);
                                var ds = data.datasets[0];
                                var arc = meta.data[i];
                                var custom = arc && arc.custom || {};
                                var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                                var arcOpts = chart.options.elements.arc;
                                var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                                var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                                var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                                var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                                return {
                                    text: label + " : " + value,
                                    fillStyle: fill,
                                    strokeStyle: stroke,
                                    lineWidth: bw,
                                    hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                                    index: i
                                };
                            });
                        } else {
                            return [];
                        }
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                        var total = meta.total;
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                        return currentValue + ' (' + percentage + '%)';
                    },
                    title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    }
                }
            }
        }

        var karyawanChart = new Chart(karyawanChartCanvas, {
            type: 'doughnut',
            data: karyawanChartData,
            options: karyawanChartOptions    
        })

        var penilaianChartCanvas = $('#penilaianChart').get(0).getContext('2d')
        var penilaianChartData        = {
            labels: [
                'Total Harus Nilai',
                'On Time',
                'Overdue' 
            ],
            datasets: [
                {
                    data: ["{{ $belumNilai }}", "{{ $ontimeAdmin }}", "{{ $overdueAdmin }}"],
                    backgroundColor : ['#00c0ef', '#3c8dbc', '#7659ba'],
                }
            ]
        }

        var penilaianChartOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            legend:{
                display: false,
                position: 'right',
                align: 'start',
                labels:{
                    generateLabels: function(chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function(label, i) {
                                var meta = chart.getDatasetMeta(0);
                                var ds = data.datasets[0];
                                var arc = meta.data[i];
                                var custom = arc && arc.custom || {};
                                var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                                var arcOpts = chart.options.elements.arc;
                                var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                                var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                                var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                                var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                                return {
                                    text: label + " : " + value,
                                    fillStyle: fill,
                                    strokeStyle: stroke,
                                    lineWidth: bw,
                                    hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                                    index: i
                                };
                            });
                        } else {
                            return [];
                        }
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                        var total = meta.total;
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                        return currentValue + ' (' + percentage + '%)';
                    },
                    title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    }
                }
            }
        }

        var penilaianChart = new Chart(penilaianChartCanvas, {
            type: 'doughnut',
            data: penilaianChartData,
            options: penilaianChartOptions    
        })

        var rekomendasiChartCanvas = $('#rekomendasiChart').get(0).getContext('2d')
        var rekomendasiChartData        = {
            labels: [
                'Habis Kontrak',
                'Direkomendasikan',
                'Tidak Direkomendasikan' 
            ],
            datasets: [
                {
                    data: ["{{ $berakhirKontrak }}", "{{ $terimaAdmin }}", "{{ $tolakAdmin }}"],
                    backgroundColor : ['#293453', '#6ed57e', '#ffd55b'],
                }
            ]
        }

        var rekomendasiChartOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            legend:{
                display: false,
                position: 'right',
                align: 'start',
                labels:{
                    generateLabels: function(chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function(label, i) {
                                var meta = chart.getDatasetMeta(0);
                                var ds = data.datasets[0];
                                var arc = meta.data[i];
                                var custom = arc && arc.custom || {};
                                var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
                                var arcOpts = chart.options.elements.arc;
                                var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
                                var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
                                var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

                                var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

                                return {
                                    text: label + " : " + value,
                                    fillStyle: fill,
                                    strokeStyle: stroke,
                                    lineWidth: bw,
                                    hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
                                    index: i
                                };
                            });
                        } else {
                            return [];
                        }
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                        var total = meta.total;
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                        return currentValue + ' (' + percentage + '%)';
                    },
                    title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                    }
                }
            }
        }

        var rekomendasiChart = new Chart(rekomendasiChartCanvas, {
            type: 'doughnut',
            data: rekomendasiChartData,
            options: rekomendasiChartOptions    
        })
        
        var umur = $('#umur').val()

        $('#habisKntrkBlnIni').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.ini') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'nilai', name: 'nilai', 
                "render" : function (nTd, sData, oData, iRow, iCol) {
                    var n = oData.nilai.toFixed(2)
                    var y = n*100
                    if(y >= 60 && y <= 100){
                        return `<span class="badge badge-pill badge-success">${y}%</span>`
                    }else if(y <= 59){
                        return `<span class="badge badge-pill badge-danger">${y}%</span>`
                    }
                }},
            ]
        })

        var filter = $('#habisKntrkBlnDpn').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('dashboard.dpn') }}",
                data: d => {
                    d.bulan = $('#filterBulan').val(),
                    d.dep = 'admin'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        })

        const bulan = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $('#filterBulan').change(function(){
            filter.draw();
            $('.bulan').text(bulan[$(this).val()])
        });
        $('#habisKntrkBlnDpn').on('draw.dt', function() {
            $('#karyawan').text(filter.ajax.json().recordsFiltered)
        });
        

    })
</script>
@endpush

@endrole

@push('info-karyawan')
<script>
const mybutton = document.getElementById("scrollUp");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('contents').style.visibility="visible";
         document.getElementById('contents').style.removeProperty('display');
      },1000);
  }
}
</script>
@endpush