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
            
            <h3 class="card-title"><i class="fas fa-info"></i> Info Karyawan</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="infoKarya" style="font-size: 0.875em;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Departemen</th>
                        <th>Kewarganegaraan</th>
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
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('info_karyawan.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'kewarganegaraan', name: 'kewarganegaraan'}
            ]
        });
      
    });

    setTimeout(function() {
        $('.alert-success').hide(500).fadeOut()
    }, 3500);
</script>
@endpush