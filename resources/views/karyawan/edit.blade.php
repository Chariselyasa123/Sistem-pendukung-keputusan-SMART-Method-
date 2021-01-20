@extends('layouts.main')

@section('title', 'Update Profile Karyawan')

@push('style')
<style>
    .profile-pic {
        position: relative;
	    display: inline-block;
    }

    .image {
        opacity: 1;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .edit {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .profile-pic:hover .image {
        opacity: 0.3;
    }

    .profile-pic:hover .edit {
        opacity: 1;
    }

    .text {
        padding: 0;
        border: none;
        outline:0 !important;
        display:block;
        border-radius: 100%;
        background-color:rgba(59, 59, 59, 0.7);
        color: white;
        font-size: 16px;
        padding: 16px 16px;
    }
    .text:active {     
        background-color:rgb(38, 38, 109);    
    }
</style>
@endpush

@section('content')
<div class="container mt-3">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-edit"></i> Update Profil karyawan</h3><a href="/info_karyawan/{{ $karyawan->id }}" class="float-right">Kembali</a>
        </div>
        <form action="/info_karyawan/{{ $karyawan->id }}" method="post">
            @method('put')
            @csrf
        <div class="card-body">
            <div class="row pb-3">
                <div class="col">
                    <div class="text-center">
                        <div class="profile-pic">
                            @if ($karyawan->foto != null)
                                <img src="{{ asset('dist/img/karyawan/'.$karyawan->foto) }}" class="image" alt="User Profile" width="200" height="200">
                            @else
                                <img src="{{ asset('dist/img/user-icon-360x360.jpg') }}" class="image" alt="User Profile" width="200" height="200">
                            @endif
                            <div class="edit">
                                <button type="button" class="text" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-pen"></i>
                                </button>
                                {{-- <a class="text" href="/upload/{{ $karyawan->id }}"><i class="fas fa-pen"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fas fa-user"></i> <b>Nama</b> <div class="float-right"><input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $karyawan->nama }}">@error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-book"></i> <b>No Induk Karyawan</b> <div class="float-right"><input type="text" class="form-control @error('no_induk_karyawan') is-invalid @enderror" name="no_induk_karyawan" value="{{ $karyawan->no_induk_karyawan }}">@error('no_induk_karyawan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-industry"></i> <b>Bagian</b> <div class="float-right"><input type="text" class="form-control @error('bagian') is-invalid @enderror" name="bagian" value="{{ $karyawan->bagian }}">@error('bagian')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-users"></i> <b>Departemen</b> <div class="float-right"><input type="text" class="form-control" name="departemen" value="{{ $karyawan->departemen }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map"></i> <b>Tempat</b> <div class="float-right"><input type="text" class="form-control" name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Tanggal Lahir</b> <div class="float-right"><input type="date" class="form-control" name="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Tanggal Masuk</b> <div class="float-right"><input type="date" class="form-control" name="tanggal_masuk" value="{{ $karyawan->tanggal_masuk }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar"></i> <b>Berakhir Kontrak</b> <div class="float-right"><input type="date" class="form-control" name="berakhir_kontrak" value="{{ $karyawan->berakhir_kontrak }}"></div>
                            </li>
                        </ul>
                    </div>{{-- end col --}}
                    
                    <div class="col">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <i class="fas fa-venus-mars"></i> <b>Jenis kelamin</b> 
                                <div class="float-right">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ $karyawan->jenis_kelamin == 'Laki-laki' ? "checked":"" }}> Laki-Laki 
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $karyawan->jenis_kelamin == 'Perempuan' ? "checked":"" }}> Perempuan
                                </div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user"></i> <b>Nama Ibu Kandung</b> <div class="float-right"><input type="text" class="form-control @error('ibu_kandung') is-invalid @enderror" name="ibu_kandung" value="{{ $karyawan->ibu_kandung }}">@error('ibu_kandung')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map"></i> <b>Alamat</b> <div class="float-right"><textarea type="text" class="form-control" name="alamat" rows="2" cols="50">{{ $karyawan->alamat }}</textarea></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-building"></i> <b>Pendidikan Terakhir</b> <div class="float-right"><input type="text" class="form-control" name="pendidikan_terakhir" value="{{ $karyawan->pendidikan_terakhir }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-flag"></i> <b>Kewarganegaraan</b> <div class="float-right"><input type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" name="kewarganegaraan" value="{{ $karyawan->kewarganegaraan }}">@error('kewarganegaraan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-circle-notch"></i> <b>Status Perkawinan</b> <div class="float-right"><input type="text" class="form-control" name="status_perkawinan" value="{{ $karyawan->status_perkawinan }}"></div>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-praying-hands"></i> <b>Agama</b> <div class="float-right"><input type="text" class="form-control" name="agama" value="{{ $karyawan->agama }}"></div>
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

<!-- Modal -->
<form action="/upload/{{ $karyawan->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                        @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="myInput" name="file" onchange="loadFile(event)">
                                <label class="custom-file-label" for="myInput">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <img id="output">
                </div>
                <div class="modal-footer">
                    <button type="submit" value="Upload" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('info-karyawan')
<script>
    $('#myInput').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endpush