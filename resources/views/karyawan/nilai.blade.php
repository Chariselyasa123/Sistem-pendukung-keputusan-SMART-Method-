@extends('layouts.main')

@section('title', 'Input Penilaian')

@role('admin')
@section('content')
<div class="container mt-3">
    <div class="card card-widget widget-user">
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $karyawan->nama }}</h3>
            <h5 class="widget-user-desc">{{ $karyawan->nik_ktp }}</h5>
        </div>
        <div class="widget-user-image">
            @if ($karyawan->foto != null)
                <img src="{{ asset('dist/img/karyawan/'.$karyawan->foto) }}" class="img-circle elevation-2" alt="User Profile" width="200" height="200">
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
            <a href="/penilaian/{{ $karyawan->id }}/nilai/{{ $bulan }}/detail" class="btn btn-default float-right moreDetail">
                Detail Nilai <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
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
                        <td>Usia</td>
                        <td>{{ $karyawan->umur }}</td>
                        <td>{!! $karyawan->data->where('kriteria_id', 6)->first()->nilai !!}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kehadiran</td>
                        <td>@if($karyawan->data->where('kriteria_id', 1)->first()->nilai == 100) 0 @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 75) {{ rand(1,3) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 50) {{ rand(4,6) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 25) {{ rand(7,10) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 0) {{ rand(10,30) }} @endif</td>
                        <td>{!! $karyawan->data->where('kriteria_id', 1)->first()->nilai !!}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Penghargaan dan Sanksi</td>
                        <td>@if($karyawan->data->where('kriteria_id', 5)->first()->nilai == 100) Penghargaan @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 75) None @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 50) SP1 @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 25) SP2 @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 0) SP3 @endif</td>
                        <td>{!! $karyawan->data->where('kriteria_id', 5)->first()->nilai !!}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Usia</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Usia 18-23 Tahun</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Usia 24-27 Tahun</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>Usia 28-30 Tahun</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Usia 31-40 tahun</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Usia > 40 tahun</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Kehadiran</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>0</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>< 3</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>4 - 6</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>7 - 10</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>> 10</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Penghargaan dan Sanksi</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Penghargaan</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>None</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>SP1 / Teguran Lisan</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>SP2</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>SP3 / Skorsing</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('info-karyawan')
<script>
    if('{{ $karyawan->status()->first()->status_kepbag }}' != 1){
        $('.moreDetail').on('click', function(e){
            e.preventDefault();
            alert('kepala Bagian Belum Melakukan Penilaian!')
        })
    }
</script>
@endpush
@else

@section('content')
<div class="container mt-3">
    <div class="card card-widget widget-user">
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $karyawan->nama }}</h3>
            <h5 class="widget-user-desc">{{ $karyawan->nik_ktp }}</h5>
        </div>
        <div class="widget-user-image">
            @if ($karyawan->foto != null)
                <img src="{{ asset('dist/img/karyawan/'.$karyawan->foto) }}" class="img-circle elevation-2" alt="User Profile" width="200" height="200">
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list"></i> Penilaian karyawan</h3>
            <a href="/penilaian/{{ $karyawan->id }}/nilai/{{ $bulan }}/detail" class="btn btn-default float-right moreDetail">
                Detail Nilai <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" style="vertical-align : middle">No</th>
                        <th rowspan="2" style="vertical-align : middle">Kriteria</th>
                        <th rowspan="2" style="vertical-align : middle">Bobot</th>
                        <th colspan="5">Jenis Penilaian</th>
                        <th rowspan="2" style="vertical-align : middle">Nilai</th>
                    </tr>
                    <tr>
                        <th>Sangat Baik</th>
                        <th>Baik</th>
                        <th>Cukup</th>
                        <th>Kurang</th>
                        <th>Sangat Kurang</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>1</td>
                        <td style="text-align: left">Motivasi Kerja</td>
                        <td style="text-align: left">15</td>
                        <td><input type="radio" name="motivasi" value="100" disabled {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 100 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="motivasi" value="75" disabled {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 75 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="motivasi" value="50" disabled {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 50 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="motivasi" value="25" disabled {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 25 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="motivasi" value="0" disabled {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 0 ? 'checked' : ''!!}></td>
                        <td>{!! $karyawan->data->where('kriteria_id', 2)->first()->nilai !!}</td>
                    </tr>
                    <tr class="text-center">
                        <td>2</td>
                        <td style="text-align: left">Komunikasi dan Tanggung jawab</td>
                        <td style="text-align: left">15</td>
                        <td><input type="radio" name="komunikasi" value="100" disabled {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 100 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="komunikasi" value="75" disabled {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 75 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="komunikasi" value="50" disabled {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 50 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="komunikasi" value="25" disabled {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 25 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="komunikasi" value="0" disabled {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 0 ? 'checked' : ''!!}></td>
                        <td>{!! $karyawan->data->where('kriteria_id', 3)->first()->nilai !!}</td>
                    </tr>
                    <tr class="text-center">
                        <td>3</td>
                        <td style="text-align: left">Penguasaan pekerjaan</td>
                        <td style="text-align: left">30</td>
                        <td><input type="radio" name="penguasaan" value="100" disabled {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 100 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="penguasaan" value="75" disabled {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 75 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="penguasaan" value="50" disabled {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 50 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="penguasaan" value="25" disabled {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 25 ? 'checked' : ''!!}></td>
                        <td><input type="radio" name="penguasaan" value="0" disabled {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 0 ? 'checked' : ''!!}></td>
                        <td>{!! $karyawan->data->where('kriteria_id', 4)->first()->nilai !!}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Motivasi Kerja</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Sangat Baik</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Baik</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>Cukup</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Kurang</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Sangat Kurang</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Komunikasi dan Tanggung jawab</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Sangat Baik</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Baik</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>Cukup</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Kurang</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Sangat Kurang</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Penguasaan pekerjaan</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kondisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Sangat Baik</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Baik</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>Cukup</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Kurang</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Sangat Kurang</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('info-karyawan')
<script>
    if('{{ $karyawan->status()->first()->status_admin }}' != 1){
        $('.moreDetail').on('click', function(e){
            e.preventDefault();
            alert('HRD Belum Melakukan Penilaian!')
        })
    }
</script>
@endpush
@endrole