@extends('layouts.main')

@section('title', 'Putus Kontrak')

@section('content')
<div class="container mt-3">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info"></i> Informasi Kriteria Penilaian</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-size: 0.875em;">
                <thead>
                    <tr class="text-centers">
                        <th>No</th>
                        <th>Jenis Kriteria</th>
                        <th>Bobot</th>
                        <th class="text-center">Normalisasi</th>
                    </tr>
                </thead>
                    @foreach ($kriterias as $kriteria)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kriteria->kriteria }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td class="text-center">{{ $kriteria->bobot / 100 }}</td>
                    </tr>
                    @endforeach
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection