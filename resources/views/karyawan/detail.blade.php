@extends('layouts.main')

@section('title', 'Info Karyawan')

@section('content')
<div class="container mt-3">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> Profil karyawan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        @if ($karyawan->foto != null)
                            <img src="{{ asset('dist/img/karyawan/'.$karyawan->foto) }}" class="image" alt="User Profile" width="200" height="200">
                        @else
                            <img src="{{ asset('dist/img/user-icon-360x360.jpg') }}" class="image" alt="User Profile" width="200" height="200">
                        @endif
                    </div>
                    <p class="text-center"><b>{{ $karyawan->nama }}</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <i class="fas fa-book"></i> <b>No Induk Karyawan</b> <div class="float-right">{{ $karyawan->no_induk_karyawan }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-industry"></i> <b>Bagian</b> <div class="float-right">{{ $karyawan->bagian }}</div>
                        </li>
                        <li class="list-group-item">
                        @if ($karyawan->tanggal_masuk == 0000-00-00)
                            <i class="fas fa-calendar"></i> <b>Tanggal Masuk</b> <div class="float-right">-</div>
                        @else
                            <i class="fas fa-calendar"></i> <b>Tanggal Masuk</b> <div class="float-right">{{ date('d F Y', strtotime($karyawan->tanggal_masuk)) }}</div>
                        @endif
                        </li>
                        <li class="list-group-item">
                        @if ($karyawan->berakhir_kontrak == 0000-00-00)
                            <i class="fas fa-calendar"></i> <b>Berakhir Kontrak</b> <div class="float-right">-</div>
                        @else
                            <i class="fas fa-calendar"></i> <b>Berakhir Kontrak</b> <div class="float-right">{{ date('d F Y', strtotime($karyawan->berakhir_kontrak)) }}</div>
                        @endif
                        </li>
                        <li class="list-group-item">
                        @if ($karyawan->berakhir_kontrak == 0000-00-00)
                            <i class="fas fa-calendar"></i> <b>Sisa Kontrak</b> <div class="float-right">-</div>
                        @else
                            <i class="fas fa-calendar"></i> <b>Sisa Kontrak</b> <div class="float-right">{{ $nowDate->diffInDays($karyawan->berakhir_kontrak, false) }} Hari lagi</div>
                        @endif
                        </li>
                        <li class="list-group-item">
                        @if ($karyawan->tanggal_lahir == 0000-00-00) 
                            <i class="fas fa-calendar"></i> <b>Tempat, Tanggal Lahir</b> <div class="float-right">-</div>
                        @else
                            <i class="fas fa-calendar"></i> <b>Tempat, Tanggal lahir</b> <div class="float-right">{{ $karyawan->tempat_lahir }}, {{ date('d F Y', strtotime($karyawan->tanggal_lahir)) }}</div>    
                        @endif
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-calendar"></i> <b>Usia</b> <div class="float-right">{{ $karyawan->umur }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-users"></i> <b>Departemen</b> <div class="float-right">{{ $karyawan->departemen }}</div>
                        </li>
                    </ul>
                </div>{{-- end col --}}
                
                <div class="col">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <i class="fas fa-mars"></i> <b>Jenis kelamin</b> <div class="float-right">{{ $karyawan->jenis_kelamin }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-user"></i> <b>Nama Ibu Kandung</b> <div class="float-right">{{ $karyawan->ibu_kandung }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-map"></i> <b>Alamat</b> <div class="float-right">{{ $karyawan->alamat }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-building"></i> <b>Pendidikan Terakhir</b> <div class="float-right">{{ $karyawan->pendidikan_terakhir }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-flag"></i> <b>Kewarganegaraan</b> <div class="float-right">{{ $karyawan->kewarganegaraan }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-circle-notch"></i> <b>Status Perkawinan</b> <div class="float-right">{{ $karyawan->status_perkawinan }}</div>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-praying-hands"></i> <b>Agama</b> <div class="float-right">{{ $karyawan->agama }}</div>
                        </li>
                    </ul>
                </div>{{-- end col --}}
            </div>{{-- end row --}}
            <div class="row mt-3">
                <div class="col text-center">
                    <a href="{{ $karyawan->id }}/edit" class="btn btn-warning">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('info-karyawan')
<script>
    $(function(){
        setTimeout(function() {
            $('.alert-success').hide(500).fadeOut()
        }, 3500);
    })
</script>
@endpush