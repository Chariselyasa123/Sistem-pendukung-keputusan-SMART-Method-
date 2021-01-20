@extends('layouts.main')

@section('title', 'Habis Kontrak')

@section('content')
<div class="container mt-3">
    <div class="card card-primary card-tabs card-outline">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-office-tab" data-toggle="pill" href="#custom-tabs-one-office" role="tab" aria-controls="custom-tabs-one-office" aria-selected="true">Office <span data-toggle="toolip" title="{{ $office }} karyawan habis kontrak" class="badge {{ $office == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px; margin-left: 2px">{{ $office }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-intake-tab" data-toggle="pill" href="#custom-tabs-one-intake" role="tab" aria-controls="custom-tabs-one-intake" aria-selected="false">Intake <span data-toggle="toolip" title="{{ $intake }} karyawan habis kontrak" class="badge {{ $intake == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $intake }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-warehousing-tab" data-toggle="pill" href="#custom-tabs-one-warehousing" role="tab" aria-controls="custom-tabs-one-warehousing" aria-selected="false">warehousing <span data-toggle="toolip" title="{{ $warehousing }} karyawan habis kontrak" class="badge {{ $warehousing == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $warehousing }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-produksi-tab" data-toggle="pill" href="#custom-tabs-one-produksi" role="tab" aria-controls="custom-tabs-one-produksi" aria-selected="false">Produksi <span data-toggle="toolip" title="{{ $produksi }} karyawan habis kontrak" class="badge {{ $produksi == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $produksi }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-qclab-tab" data-toggle="pill" href="#custom-tabs-one-qclab" role="tab" aria-controls="custom-tabs-one-qclab" aria-selected="false">QcLab <span data-toggle="toolip" title="{{ $qclab }} karyawan habis kontrak" class="badge {{ $qclab == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $qclab }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-ga-tab" data-toggle="pill" href="#custom-tabs-one-ga" role="tab" aria-controls="custom-tabs-one-ga" aria-selected="false">Ga <span data-toggle="toolip" title="{{ $ga }} karyawan habis kontrak" class="badge {{ $ga == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $ga }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-truckscale-tab" data-toggle="pill" href="#custom-tabs-one-truckscale" role="tab" aria-controls="custom-tabs-one-truckscale" aria-selected="false">Truck Scale <span data-toggle="toolip" title="{{ $truckscale }} karyawan habis kontrak" class="badge {{ $truckscale == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $truckscale }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-premix-tab" data-toggle="pill" href="#custom-tabs-one-premix" role="tab" aria-controls="custom-tabs-one-premix" aria-selected="false">Premix <span data-toggle="toolip" title="{{ $premix }} karyawan habis kontrak" class="badge {{ $premix == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $premix }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-maintance-tab" data-toggle="pill" href="#custom-tabs-one-maintance" role="tab" aria-controls="custom-tabs-one-maintance" aria-selected="false">Maintance <span data-toggle="toolip" title="{{ $maintance }} karyawan habis kontrak" class="badge {{ $maintance == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $maintance }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-kebersihan-tab" data-toggle="pill" href="#custom-tabs-one-kebersihan" role="tab" aria-controls="custom-tabs-one-kebersihan" aria-selected="false">Kebersihan <span data-toggle="toolip" title="{{ $kebersihan }} karyawan habis kontrak" class="badge {{ $kebersihan == 0 ? 'badge-primary' : 'badge-warning' }} float-right" style="margin-top: 2px; margin-left: 2px">{{ $kebersihan }}</span></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-office" role="tabpanel" aria-labelledby="custom-tabs-one-office-tab">
                    @if ($office != 0)
                    <a href="/habis_kontrak/office/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblOffice">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> 
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-intake" role="tabpanel" aria-labelledby="custom-tabs-one-intake-tab">
                    @if ($intake != 0)
                    <a href="/habis_kontrak/intake/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblIntake">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> 
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-warehousing" role="tabpanel" aria-labelledby="custom-tabs-one-warehousing-tab">
                    @if ($warehousing != 0)
                    <a href="/habis_kontrak/warehousing/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblwarehousing">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-produksi" role="tabpanel" aria-labelledby="custom-tabs-one-produksi-tab">
                    @if ($produksi != '0')
                    <a href="/habis_kontrak/produksi/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblProduksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-qclab" role="tabpanel" aria-labelledby="custom-tabs-one-qclab-tab">
                    @if ($qclab != 0)
                    <a href="/habis_kontrak/qclab/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblQclab">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-ga" role="tabpanel" aria-labelledby="custom-tabs-one-ga-tab">
                    @if ($ga != 0)
                    <a href="/habis_kontrak/ga/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblGa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-truckscale" role="tabpanel" aria-labelledby="custom-tabs-one-truckscale-tab">
                    @if ($truckscale != 0)
                    <a href="/habis_kontrak/truckscale/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblTruckScale">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-premix" role="tabpanel" aria-labelledby="custom-tabs-one-premix-tab">
                    @if ($premix != 0)
                    <a href="/habis_kontrak/premix/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblPremix">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-maintance" role="tabpanel" aria-labelledby="custom-tabs-one-maintance-tab">
                    @if ($maintance != 0)
                    <a href="/habis_kontrak/maintance/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblMaintance">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 </div>
                <div class="tab-pane fade" id="custom-tabs-one-kebersihan" role="tabpanel" aria-labelledby="custom-tabs-one-kebersihan-tab">
                    @if ($kebersihan != 0)
                    <a href="/habis_kontrak/kebersihan/print" class="btn btn-app" target="_blank"><i class="fas fa-print"></i> PRINT</a>
                    @else
                    @endif
                    <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="tblKebersihan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Induk Karyawan</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Departemen</th>
                                <th>Tanggal Masuk</th>
                                <th>Berakhir Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                 
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

@endsection

@push('info-karyawan')
<script type="text/javascript">
    $(function () {
        $('#tblOffice').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.office') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblIntake').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.intake') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblwarehousing').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.warehousing') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblProduksi').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.produksi') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak', 
                    "render" : function (ntd, sData, oData, iRow, iCol) {
                            const d = new Date(oData.berakhir_kontrak)
                            const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d)
                            const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(d)
                            const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d)
                            return `${da} ${mo} ${ye}`
                        }
                }
            ]
        });
        $('#tblQclab').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.qclab') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblGa').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.ga') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblTruckScale').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.truckscale') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblPremix').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.premix') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblMaintance').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.maintance') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
        $('#tblKebersihan').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('habis_kontrak.kebersihan') }}",
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'no_induk_karyawan', name: 'no_induk_karyawan'},
                {data: 'nama', name: 'nama', 
                    "render" : function (nTd, sData, oData, iRow, iCol) {
                    return "<a href='/info_karyawan/"+oData.id+"'>"+oData.nama+"</a>";
                }}, 
                {data: 'bagian', name: 'bagian'},
                {data: 'departemen', name: 'departemen'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'berakhir_kontrak', name: 'berakhir_kontrak'}
            ]
        });
      
    });
</script>
@endpush