@extends('layouts.main')

@section('title', 'Input Karyawan')

@section('content')
<div class="container mt-3">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> Input karyawan</h3>
        </div>
        <form action="/info_karyawan/" method="post">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fas fa-user"></i> <b>Nama</b> <div class="float-right"><input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukkan Nama">@error('nama')<div id="namaFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-book"></i> <b>No Induk Karyawan</b> <div class="float-right"><input type="text" class="form-control @error('no_induk_karyawan') is-invalid @enderror" name="no_induk_karyawan" id="no_induk_karyawan" placeholder="Masukkan Nomor Induk Karyawan">@error('no_induk_karyawan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-industry"></i> <b>Bagian</b> <div class="float-right"><input type="text" class="form-control @error('bagian') is-invalid @enderror" name="bagian" id="bagian" placeholder="Masukkan Nama Bagian">@error('bagian')<div class="invalid-feedback">{{ $message }}</div>@enderror</div> 
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-users"></i> <b>Departemen</b> <div class="float-right"><input type="text" class="form-control @error('departemen') is-invalid @enderror" name="departemen" placeholder="Masukkan Departemen">@error('departemen')<div id="departemenFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Tanggal Masuk</b> <div class="float-right"><input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk">@error('tanggal_masuk')<div id="tglMasukFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Berakhir Kontrak</b> <div class="float-right"><input type="date" class="form-control @error('berakhir_kontrak') is-invalid @enderror" name="berakhir_kontrak">@error('berakhir_kontrak')<div id="akhrKntrkFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map"></i> <b>Tempat Lahir</b> <div class="float-right"><input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir">@error('tempat_lahir')<div id="tglLhrFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Tanggal Lahir</b> <div class="float-right"><input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir">@error('tanggal_lahir')<div id="tglLhrFeedback" class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                        </ul>
                    </div>{{-- end col --}}
                    
                    <div class="col">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fas fa-venus-mars"></i> <b>Jenis kelamin</b> 
                                <div class="float-right">
                                    <Select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option selected disabled>Pilih Jenis kelamin...</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </Select>
                                    @error('jenis_kelamin')<div id="jenisKelaminFeedback" class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user"></i> <b>Nama Ibu Kandung</b> <div class="float-right"><input type="text" class="form-control @error('ibu_kandung') is-invalid @enderror" name="ibu_kandung" id="ibu_kandung" placeholder="Masukkan Nama Ibu Kandung">@error('ibu_kandung')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map"></i> <b>Alamat</b> <div class="float-right"><textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2" cols="50" placeholder="Masukkan Alamat"></textarea>@error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-building"></i> <b>Pendidikan Terakhir</b> <div class="float-right"><input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir">@error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-flag"></i> <b>Kewarganegaraan</b> <div class="float-right"><input type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" name="kewarganegaraan" id="kewarganegaraan" placeholder="Masukkan Kewarganegaraan">@error('kewarganegaraan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-circle-notch"></i> <b>Status Perkawinan</b> <div class="float-right"><input type="text" class="form-control @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan" placeholder="Masukkan Status perkawinan">@error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-praying-hands"></i> <b>Agama</b> <div class="float-right"><input type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" placeholder="Masukkan Agama">@error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                        </ul>
                    </div>{{-- end col --}}
                </div>{{-- end row --}}
                <div class="row mt-3">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection