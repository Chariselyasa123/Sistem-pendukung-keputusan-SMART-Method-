@extends('layouts.main')

@section('title', 'Input Penilaian')

@section('content')
<div class="container mt-3">
    <div class="card card-widget widget-user">
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $karyawan->nama }}</h3>
            <h5 class="widget-user-desc">{{ $karyawan->nik_ktp }}</h5>
        </div>
        <div class="widget-user-image">
            @if ($karyawan->foto != null)
                <img src="{{ asset('dist/img/karyawan/'.$karyawan->foto) }}" class="imaimg-circle elevation-2ge" alt="User Profile" width="200" height="200">
            @else
                <img src="{{ asset('dist/img/user-icon-360x360.jpg') }}" class="img-circle elevation-2" alt="User Profile" width="200" height="200">
            @endif
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">Bagian</h5>
                        <span class="description-text">{{ $karyawan->bagian }}</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">No Induk Karyawan</h5>
                        <span class="description-text">{{ $karyawan->no_induk_karyawan }}</span>
                    </div>
                <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> History Penilaian karyawan</h3>
            <a href="/penilaian/{{ $karyawan->id }}/nilai/{{ $bulan }}/print" class="btn btn-app float-right" target="_blank"><i class="fas fa-print"></i> PRINT</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Kondisi</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kehadiran</td>
                        <td>@if($nilai[0]['nilai'] == 100) 0 @elseif($nilai[0]['nilai'] == 75) {{ rand(1,3) }} @elseif($nilai[0]['nilai'] == 50) {{ rand(4,6) }} @elseif($nilai[0]['nilai'] == 25) {{ rand(7,10) }} @elseif($nilai[0]['nilai'] == 0) {{ rand(10,30) }} @endif</td>
                        <td>{{ $nilai[0]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Motivasi Kerja</td>
                        <td>@if($nilai[1]['nilai'] == 100) Sangat Baiik @elseif($nilai[1]['nilai'] == 75) Baik @elseif($nilai[1]['nilai'] == 50) Cukup @elseif($nilai[1]['nilai'] == 25) Kurang @elseif($nilai[1]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[1]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Komunikasi dan Tanggung Jawab</td>
                        <td>@if($nilai[2]['nilai'] == 100) Sangat Baiik @elseif($nilai[2]['nilai'] == 75) Baik @elseif($nilai[2]['nilai'] == 50) Cukup @elseif($nilai[2]['nilai'] == 25) Kurang @elseif($nilai[2]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[2]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Penguasaan Pekerjaan</td>
                        <td>@if($nilai[3]['nilai'] == 100) Sangat Baiik @elseif($nilai[3]['nilai'] == 75) Baik @elseif($nilai[3]['nilai'] == 50) Cukup @elseif($nilai[3]['nilai'] == 25) Kurang @elseif($nilai[3]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[3]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Penghargaan dan Sanksi</td>
                        <td>@if($nilai[4]['nilai'] == 100) Penghargaan @elseif($nilai[4]['nilai'] == 75) None @elseif($nilai[4]['nilai'] == 50) SP1 @elseif($nilai[4]['nilai'] == 25) SP2 @elseif($nilai[4]['nilai'] == 0) SP3 @endif</td>
                        <td>{{ $nilai[4]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Usia</td>
                        <td>{{ $karyawan->umur }}</td>
                        <td>{{ $nilai[5]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Nilai Akhir</strong></td>
                        <td><span class="badge {{ round($smartMethod->nilai, 2) * 100 > 60 ? 'badge-success' : 'badge-danger' }}">{{ round($smartMethod->nilai, 2) * 100 }}%</span></td>
                    </tr>
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
</div>
@endsection