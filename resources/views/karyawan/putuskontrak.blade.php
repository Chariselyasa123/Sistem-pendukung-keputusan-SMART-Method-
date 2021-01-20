@extends('layouts.main')

@section('title', 'Putus Kontrak')

@section('content')
<div class="container mt-3">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-table"></i> List Karyawan Putus Kontrak PT. Dua Benua Pratama</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowarp" id="tabelPtsKntrk" style="font-size: 0.875em;">
                <thead>
                    <tr class="text-centers">
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Divisi</th>
                        <th>Putus Kontrak</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('info-karyawan')
<script>
    $(function(){
        var table = $('#tabelPtsKntrk').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('putus_kontrak.pts') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nik_ktp', name: 'nik_ktp'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'divisi', name: 'divisi'},
                {data: 'resign', name: 'resign',
                    "render" : function (ntd, sData, oData, iRow, iCol) {
                        const d = new Date(oData.resign)
                        const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d)
                        const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(d)
                        const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d)
                        return `${da} ${mo} ${ye}`
                    }
                },
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        return `<a href="/penilaian/${oData.id}/nilai" class="btn btn-success">${oData.action}</a>`
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        })
    })
</script>
@endpush
