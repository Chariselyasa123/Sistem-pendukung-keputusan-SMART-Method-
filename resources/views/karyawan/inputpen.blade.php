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
            <h3 class="card-title"><i class="fas fa-list"></i> Penilaian karyawan</h3>
        </div>
        <div class="card-body">
            <form action="/penilaian/" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Usia</label>
                <div class="col-sm-2">
                    <span>{{ $karyawan->umur }} Tahun</span>
                    <input type="hidden" value="{{ $karyawan->umur }}" id="usia">
                    <input type="hidden" value="" id="nilaiUmur" name="nilaiUmur">
                    <input type="hidden" name="usia_id" value="{{ $usia->id }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="kehadiran" class="col-sm-2 col-form-label">Kehadiran</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('kehadiran') is-invalid @enderror" id="kehadiran" name="kehadiran" placeholder="input">
                    <input type="hidden" name="kehadiran_id" value="{{ $kehadiran->id }}">
                    @error('kehadiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="pAndS" class="col-sm-2 col-form-label">Penghargaan dan Sanksi</label>
                <div class="col-sm-2">
                    <select class="form-control @error('pAndS') is-invalid @enderror" name="pAndS" id="pAndS">
                        <option selected disabled>Pilih...</option>
                        <option value="100">Penghargaan</option>
                        <option value="75">None</option>
                        <option value="50">SP1</option>
                        <option value="25">SP2</option>
                        <option value="0">SP3</option>
                    </select>
                    @error('pAndS')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <input type="hidden" name="pAndS_id" value="{{ $pAndS->id }}">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>

</div>
@endsection

@push('info-karyawan')
<script>
const usia = document.getElementById('usia').value;
const umur = parseInt(usia);
const nilaiUmur = document.getElementById('nilaiUmur');
console.log(usia)
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
            <form action="/penilaian/" method="post">
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
            <input type="hidden" name="motivasi_id" value="{{ $motivasi->id }}">
            <input type="hidden" name="komunikasi_id" value="{{ $komunikasi->id }}">
            <input type="hidden" name="penguasaan_id" value="{{ $penguasaan->id }}">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Komponen Nilai</th>
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
                        <td><input type="radio" name="motivasi" value="100"></td>
                        <td><input type="radio" name="motivasi" value="75"></td>
                        <td><input type="radio" name="motivasi" value="50"></td>
                        <td><input type="radio" name="motivasi" value="25"></td>
                        <td><input type="radio" name="motivasi" value="0"></td>
                    </tr>
                    <tr class="text-center">
                        <td>2</td>
                        <td style="text-align: left">Komunikasi dan Tanggung jawab</td>
                        <td><input type="radio" name="komunikasi" value="100"></td>
                        <td><input type="radio" name="komunikasi" value="75"></td>
                        <td><input type="radio" name="komunikasi" value="50"></td>
                        <td><input type="radio" name="komunikasi" value="25"></td>
                        <td><input type="radio" name="komunikasi" value="0"></td>
                    </tr>
                    <tr class="text-center">
                        <td>3</td>
                        <td style="text-align: left">Penguasaan pekerjaan</td>
                        <td><input type="radio" name="penguasaan" value="100"></td>
                        <td><input type="radio" name="penguasaan" value="75"></td>
                        <td><input type="radio" name="penguasaan" value="50"></td>
                        <td><input type="radio" name="penguasaan" value="25"></td>
                        <td><input type="radio" name="penguasaan" value="0"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        </div>
    </div>
</div>
@endsection
@endrole
