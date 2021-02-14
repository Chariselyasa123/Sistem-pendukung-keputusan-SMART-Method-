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
        <form action="/penilaian/{{ $karyawan->id }}" method="post" class="form-horizontal">
            @method('put')
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
            <input type="hidden" value="{{ $karyawan->umur }}" id="usia">
            <input type="hidden" value="" id="nilaiUmur" name="nilaiUmur">
            <input type="hidden" name="usia_id" value="{!! $karyawan->data->where('kriteria_id', 6)->first()->kriteria_id !!}">
            <input type="hidden" name="kehadiran_id" value="{!! $karyawan->data->where('kriteria_id', 1)->first()->kriteria_id !!}">
            <input type="hidden" name="pAndS_id" value="{!! $karyawan->data->where('kriteria_id', 5)->first()->kriteria_id !!}">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Edit Penilaian karyawan</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Usia</td>
                            <td>{!! $karyawan->data->where('kriteria_id', 6)->first()->kriteria->bobot !!}</td>
                            <td><span class="ml-3">{{ $karyawan->umur }} Tahun</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kehadiran</td>
                            <td>{!! $karyawan->data->where('kriteria_id', 1)->first()->kriteria->bobot !!}</td>
                            <td>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control  @error('kehadiran') is-invalid @enderror" id="kehadiran" name="kehadiran" value="@if($karyawan->data->where('kriteria_id', 1)->first()->nilai == 100) 0 @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 75) {{ rand(1,3) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 50) {{ rand(4,6) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 25) {{ rand(7,10) }} @elseif($karyawan->data->where('kriteria_id', 1)->first()->nilai == 0) {{ rand(10,30) }} @endif">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Penghargaan dan Sanksi</td>
                            <td>{!! $karyawan->data->where('kriteria_id', 5)->first()->kriteria->bobot !!}</td>
                            <td>
                                <div class="col-sm-4">
                                    <select class="form-control @error('pAndS') is-invalid @enderror" name="pAndS" id="pAndS">
                                        <option selected disabled>@if($karyawan->data->where('kriteria_id', 5)->first()->nilai == 100) Penghargaan @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 75) None @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 50) SP1 @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 25) SP2 @elseif($karyawan->data->where('kriteria_id', 5)->first()->nilai == 0) SP3 @endif</option>
                                        <option value="100">Penghargaan</option>
                                        <option value="75">None</option>
                                        <option value="50">SP1</option>
                                        <option value="25">SP2</option>
                                        <option value="0">SP3</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('info-karyawan')
<script>
const usia = document.getElementById('usia').value;
const umur = parseInt(usia);
const nilaiUmur = document.getElementById('nilaiUmur');
if(umur >= 18 && umur <= 23){
    nilaiUmur.value = 100
}else if(umur >= 24 && umur <= 27){
    nilaiUmur.value = 75
}else if(umur >= 28 && umur <= 30){
    nilaiUmur.value = 50
}else if(umur >= 31 && umur <= 40){
    nilaiUmur.value = 25
}else if(umur > 40){
    nilaiUmur.value = 0
}

// Fungsi untuk restrict input angka only dll.
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}

setInputFilter(document.getElementById("kehadiran"), function(value) {return /^-?\d*$/.test(value)});

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
        </div>
        <div class="card-body">
            <form action="/penilaian/{{ $karyawan->id }}" method="post" class="form-horizontal">
            @method('put')
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
            <input type="hidden" name="motivasi_id" value="{!! $karyawan->data->where('kriteria_id', 2)->first()->kriteria_id !!}">
            <input type="hidden" name="komunikasi_id" value="{!! $karyawan->data->where('kriteria_id', 3)->first()->kriteria_id !!}">
            <input type="hidden" name="penguasaan_id" value="{!! $karyawan->data->where('kriteria_id', 4)->first()->kriteria_id !!}">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" style="vertical-align : middle">No</th>
                        <th rowspan="2" style="vertical-align : middle">Kriteria</th>
                        <th rowspan="2" style="vertical-align : middle">Bobot</th>
                        <th colspan="5">Jenis Penilaian</th>
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
                        <td>{!! $karyawan->data->where('kriteria_id', 2)->first()->kriteria->bobot !!}</td>
                        <td><input type="radio" name="motivasi" value="100" {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 100 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="motivasi" value="75" {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 75 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="motivasi" value="50" {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 50 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="motivasi" value="25" {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 25 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="motivasi" value="0" {!! $karyawan->data->where('kriteria_id', 2)->first()->nilai == 0 ? 'checked' : '' !!}></td>
                    </tr>
                    <tr class="text-center">
                        <td>2</td>
                        <td style="text-align: left">Komunikasi dan Tanggung jawab</td>
                        <td>{!! $karyawan->data->where('kriteria_id', 3)->first()->kriteria->bobot !!}</td>
                        <td><input type="radio" name="komunikasi" value="100" {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai == 100 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="komunikasi" value="75" {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai  == 75 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="komunikasi" value="50" {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai  == 50 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="komunikasi" value="25" {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai  == 25 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="komunikasi" value="0" {!! $karyawan->data->where('kriteria_id', 3)->first()->nilai  == 0 ? 'checked' : '' !!}></td>
                    </tr>
                    <tr class="text-center">
                        <td>3</td>
                        <td style="text-align: left">Penguasaan pekerjaan</td>
                        <td>{!! $karyawan->data->where('kriteria_id', 4)->first()->kriteria->bobot !!}</td>
                        <td><input type="radio" name="penguasaan" value="100" {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai  == 100 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="penguasaan" value="75" {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 75 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="penguasaan" value="50" {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 50 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="penguasaan" value="25" {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 25 ? 'checked' : '' !!}></td>
                        <td><input type="radio" name="penguasaan" value="0" {!! $karyawan->data->where('kriteria_id', 4)->first()->nilai == 0 ? 'checked' : '' !!}></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
@endrole