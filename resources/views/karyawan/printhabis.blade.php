@extends('layouts.print')

@section('content')
<div  style="padding:0px 30px 0px 30px">
    <div style="float:left" class="form-group">
    <img src="{{ asset('dist/img/2019-03-14.png') }}"></div>
    <div style="float:center" class="form-group">
     <h3 class="text-center"><b>PT. DUA BENUA PRATAMA </b></h3><br></div>
    <br>
    <HR>
    </div>
    
      <div style="float:right;" class="form-group"> 
      <B>Tangerang, {{ date('d-F-Y') }}&emsp;&nbsp;&nbsp;&nbsp; </B>
      </div>
      <Br>
    
    <!--header-->
    <style>
    .tengah , th {
        text-align:center;
        vertical-align:middle;
    }
    table {
      font-size: 12px
    }
    .tablefont td , .tablefont th  {
      border:0px
    }
    
    </style>
    <body onload="window.print()">
    <div  style="padding:0px 30px 0px 30px">
    <div align="left">
    Yth. Ibu Nelitasari<br>
    Personalia Manager<br>
    Di<br>
    PT Charoen Pokphand Indonesia Balaraja<br>
    <br>
    @php
        $bulan = date('n'); 
        $bln = ''; 
    @endphp
    @switch($bulan)
        @case(1)
            @php $bln = 'I' @endphp
            @break
        @case(2)
            @php $bln = 'II' @endphp
            @break
        @case(3)
            @php $bln = 'III' @endphp
            @break
        @case(4)
            @php $bln = 'VI' @endphp
            @break
        @case(5)
            @php $bln = 'V' @endphp
            @break
        @case(6)
            @php $bln = 'VI' @endphp
            @break
        @case(7)
            @php $bln = 'VII' @endphp
            @break
        @case(8)
            @php $bln = 'VIII' @endphp
            @break
        @case(9)
            @php $bln = 'IX' @endphp
            @break
        @case(10)
            @php $bln = 'X' @endphp
            @break
        @case(11)
            @php $bln = 'XI' @endphp
            @break
        @case(12)
            @php $bln = 'XII' @endphp
            @break
        @default
            {{ "" }}
    @endswitch
    @php
        $tahun = date('Y');
        $nomor = "/DBSP/SI-PAK/$bln/$tahun";
        empty($out) ? $no : $no=$out[0]->maxKode;
        $noUrut = $no + 1;
        $kode = sprintf("%03s", $noUrut);
        $nomorbaru = $kode.$nomor
    @endphp
    
    No&emsp;&emsp;&nbsp;&nbsp;: {{ $nomorbaru }}<br>
    Hal &emsp;&emsp;: Konfirmasi Kontrak Karyawan PT DBP<br>
    Lamp &emsp;: 1 Berkas<br>
    <br>
    <div align="justify">
    Bersama ini kami lampirkan form konfirmasi status kontrak karyawan PT DBP yang dalam waktu dekat akan berakhir kontrak kerjanya. Mohon masukan serta tanggapan dari pihak PT CPI selaku User, sebagai pertibangan atas kontrak karyawan periode berikutnya.
    </div>
    </div>
    <br>
    Adapun list karyawan yang akan habis kontrak di bulan {{ date('F') }}<br><Br>
    <div class="box-body">
    <style>
    .tengah , th {
        text-align:center;
        vertical-align:middle;
    }
    </style>
    @php
        if ($departemen == 'produksi'){
            $dataPrint = $dataProduksi;
        } else if($departemen == 'truckscale') {
            $dataPrint = $dataTruck;
        } else {
            $dataPrint = $data;
        }
    @endphp
    <table class="table table-bordered">
        <thead>
        <tr>
            <td><b>No</b></td>
            <td><b>Nama</b></td>
            <td><b>Bagian</b></td>
            <td><b>Tanggal Masuk</b></td>
            <td><b>Berakhir Kontrak</b></td>
        </tr>
        </thead>
        <tbody>
        @foreach ($dataPrint as $dp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dp->nama }}</td>
                <td>{{ $dp->bagian }}</td>
                <td>{{ date("d F Y", strtotime($dp->tanggal_masuk)) }}</td>
                <td>{{ date("d F Y", strtotime($dp->berakhir_kontrak)) }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div align="justify">
    Demikian surat konfirmasi karyawan PT DBP ini kami sampaikan. Atas perhatian Bapak/Ibu Pimpinan PT Charoen Pokphand Indonesia Balaraja, kami mengucapkan terimakasih.
    <br>
    <br>
    <br>
    &nbsp;&nbsp;Balaraja, {{date('d F Y')}}<br>
    &nbsp;&nbsp;Dilaporkan Oleh<br>
    <br><br><br><br>
    &nbsp;&nbsp;&nbsp;(_________________)<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager HRD
    </div>
</div>
@endsection