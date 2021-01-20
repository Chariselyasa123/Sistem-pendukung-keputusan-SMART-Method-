@extends('layouts.main')

@section('title', 'Penilaian')

@section('content')
<div class="container mt-3">
    @if (session('status'))
        <div class="alert alert-success" id="flashSuccess">
            {{ session('status') }}
        </div>
    @endif

    {{-- Alter Overdue! --}}
    @role('admin')
    @if(isset($statusAdmin[0]))
        @if ($isNullAdmin == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusAdmin[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusAdmin[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('office')
    @if(isset($statusOffice[0]))
        @if ($isNullOffice == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusOffice[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusOffice[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('intake')
    @if(isset($statusIntake[0]))
        @if ($isNullIntake == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusIntake[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusIntake[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('warehouse')
    @if(isset($statusWarehousing[0]))
        @if ($isNullWarehousing == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusWarehousing[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusWarehousing[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('produksi')
    @if(isset($statusProduksi[0]))
        @if ($isNullProduksi == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusProduksi[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusProduksi[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('qclab')
    @if(isset($statusQclab[0]))
        @if ($isNullLab == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusLab[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusQcab[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('ga')
    @if(isset($statusGa[0]))
        @if ($isNullGa == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusGa[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusGa[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('truck')
    @if(isset($statusTruck[0]))
        @if ($isNullTruck == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusTruck[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusTruck[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('premix')
    @if(isset($statusPremix[0]))
        @if ($isNullPremix == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusPremix[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusPremix[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('maintance')
    @if(isset($statusMaintance[0]))
        @if ($isNullMaintance == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusMaintance[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusMaintance[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @elserole('kebersihan')
    @if(isset($statusKebersihan[0]))
        @if ($isNullKebersihan == True && $nowDate >= $nowDate->endOfMonth()->addDays(-14))
        <div class="alert alert-danger alert-dismissible" id="alertOverdue">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian</h5>
            <p>Terdapat{{ $statusKebersihan[0] }} Karyawan yang <strong>Overdue!</strong> Segera lakukan <b>Penilaian!</b></p>
        </div>
        @endif
    <div class="alert alert-info alert-dismissible d-none" id="alertInfo">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-info-circle"></i> Perhatian</h5>
        <p>Terdapat {{ $statusKebersihan[0] }} Karyawan yang <strong>Belum Dinilai!</strong> Segera lakukan <b>Penilaian!</b> sebelum <strong>Overdue!</strong></p>
    </div>
    @endif
    @endrole
    {{-- End Alert Overdue! --}}

    {{-- Alert Success! --}}
    @role('admin')
    @if(!isset($statusAdmin[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('office')
    @if(!isset($statusOffice[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('intake')
    @if(!isset($statusIntake[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('warehouse')
    @if(!isset($statusWarehousing[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('produksi')
    @if(!isset($statusProduksi[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('ga')
    @if(!isset($statusGa[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('qclab')
    @if(!isset($statusQclab[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('truck')
    @if(!isset($statusTruck[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('premix')
    @if(!isset($statusPremix[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('maintance')
    @if(!isset($statusMaintance[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @elserole('kebersihan')
    @if(!isset($statusKebersihan[0]))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-check-circle"></i> Perhatian</h5>
        <p>Semua karyawan telah dinilai</p>
    </div>
    @endif
    @endrole
    {{-- End Alert Success! --}}

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> List karyawan yang Akan Habis Kontrak Bulan {{ date('F') }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="infoKarya" style="font-size: 0.875em;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Induk Karyawan</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Berakhir Kontrak</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="row mt-3 ml-1">
                <span class="badge badge-pill badge-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><i>&nbsp;&nbsp;&nbsp;On Time! Telah Melakukan Penginputan Nilai</i>
            </div>
            <div class="row mt-1 ml-1">
                <span class="badge badge-pill badge-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><i>&nbsp;&nbsp;&nbsp;Belum Melakukan Penginputan Nilai 14 hari sebelum kontrak habis</i>
            </div>
            @role('admin')
            <div class="row mt-1 ml-1">
                <span class="badge badge-pill" style="background-color: #ffc107">History</span><i>&nbsp;&nbsp;&nbsp;*History bisa diakses setelah kepala bagian melakukan penilaian</i>
            </div>
            @else
            <div class="row mt-1 ml-1">
                <span class="badge badge-pill" style="background-color: #ffc107">History</span><i>&nbsp;&nbsp;&nbsp;*History bisa diakses setelah HRD melakukan penilaian</i>
            </div>
            @endrole
        </div>
    </div>
</div>
@endsection

@role('admin')
@push('info-karyawan')
<script type="text/javascript">

    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.pen') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'departemen', name: 'departemen'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_admin', name: 'status', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_admin == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_admin == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_admin == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_kepbag == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_kepbag == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('office')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.off') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('intake')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.in') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('warehouse')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.war') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('produksi')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.prod') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('qclab')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.qc') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('ga')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.ga') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('truck')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.truck') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('premix')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.pre') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('maintance')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.main') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@elserole('kebersihan')
@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        var table = $('#infoKarya').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('penilaian.keb') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        if (oData.status != 1){
                            return "<a href='/penilaian/"+oData.id+"/input'>"+oData.nama+"</a>";
                        }else{
                            return oData.nama
                        }
                }},
                {data: 'departemen', name: 'departemen'},   
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'},
                {data: 'status_kepbag', name: 'status_kepbag', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                        const nowDate = new Date().toJSON().slice(0,10);
                        const diffDates = (startDate, endDate) => {
                            const start = new Date(startDate)
                            const end = new Date(endDate)
                            let dayCount = 0

                            while (end > start) {
                                dayCount++
                                start.setDate(start.getDate() + 1)
                            }

                            return dayCount
                        }
                        if(oData.status_kepbag == 0){
                            if(diffDates(nowDate, oData.berakhir_kontrak) <= 14) return `<span class="badge badge-pill badge-danger">Overdue!</span><span class="badge badge-pill badge-warning">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi!</span>`
                            return `<span class="badge badge-pill badge-warning">Belum Nilai!</span><span class="badge badge-pill badge-info">${diffDates(nowDate, oData.berakhir_kontrak)} Hari Lagi</span>`
                        }else if(oData.status_kepbag == 1){
                            return `<span class="badge badge-pill badge-success">Sudah Dinilai</span>`
                        }
                }},
                {
                    data: 'action', 
                    name: 'action', 
                    "render" : function (nTd, sData, oData, iRow, iCol){
                        if(oData.status_kepbag == 0) {
                            return "<a href='/penilaian/"+oData.id+"/input' class='btn btn-info'>Nilai</a>";
                        }else if(oData.status_admin == 1){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning">History</a>';
                        }else if(oData.status_admin == 0){
                            return '<a href="/penilaian/'+oData.id+'/nilai" class="btn btn-warning" disabled>History</a>';
                        }
                    },
                    orderable: true, 
                    searchable: true
                },
            ]
        });
      
    });

    setTimeout(function() {
        $('#flashSuccess').hide(500).fadeOut()
    }, 3500);
</script>
@endpush
@endrole