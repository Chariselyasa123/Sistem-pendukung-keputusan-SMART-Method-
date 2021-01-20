@extends('layouts.print')

@section('content')
<div  style="padding:0px 30px 0px 30px">

    <center>
    <img src="{{ asset('dist/img/2019-03-14.png') }}"><h3><b>PT. DUA BENUA PRATAMA </b></h3> <br>
    </center>
    <HR>
    </div>
  
      <center>
      <B>PENILAIAN KARYAWAN </B>
      </CENTER>
      <Br>
  
    <!--header-->
    <style>
    .tengah , th {
        text-align:center;
        vertical-align:middle;
    }
    table {
      font-size: 15px
    }
    .tablefont td , .tablefont th  {
      border:0px
    }
  
    </style>
    <body onload="window.print()">
    <div  style="padding:0px 30px 0px 30px">
    <div class="box box-primary">
    <div class="box-header with-border">
      <h5 class="box-title"><i class="fa fa-fw fa-check-square-o"></i> Hasil Penilaian Karyawan</h5>
    </div>
    <div class="box-body">
  
    <table>
        <tr>
            <td >Nama</td>
            <td>: {{ $karyawan->nama }}</td>
  
            <td align="left" width=100px style="padding-left: 20px">Bagian</td>
            <td>: {{ $karyawan->bagian }}</td>
        </tr>
        <tr>
            <td >Departemen</td>
            <td>: {{ $karyawan->departemen }}</td>
  
            <td align="left" style="width: 200px; padding-left: 20px">Nomor Induk Karyawan</td>
            <td>: {{ $karyawan->no_induk_karyawan }}</td>
        </tr>
    </table>
  
  <br>
    <div class="box box-primary">
    <div class="box-header with-border">
      <h5 class="box-title"><i class="fa fa-fw fa-check-square-o"></i> Hasil Nilai</h5>
    </div>
    <div class="box-body">
    <style>
    .tengah , th {
        text-align:center;
        vertical-align:middle;
    }
    </style>
    <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Kondisi</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kehadiran</td>
                        <td>@if($nilai[0]['nilai'] == 100) 0 @elseif($nilai[0]['nilai'] == 75) {{ rand(1,3) }} @elseif($nilai[0]['nilai'] == 50) {{ rand(4,6) }} @elseif($nilai[0]['nilai'] == 25) {{ rand(7,10) }} @elseif($nilai[0]['nilai'] == 0) {{ rand(10,30) }} @endif</td>
                        <td>{{ $nilai[0]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Motivasi Kerja</td>
                        <td>@if($nilai[1]['nilai'] == 100) Sangat Baiik @elseif($nilai[1]['nilai'] == 75) Baik @elseif($nilai[1]['nilai'] == 50) Cukup @elseif($nilai[1]['nilai'] == 25) Kurang @elseif($nilai[1]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[1]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Komunikasi dan Tanggung Jawab</td>
                        <td>@if($nilai[2]['nilai'] == 100) Sangat Baiik @elseif($nilai[2]['nilai'] == 75) Baik @elseif($nilai[2]['nilai'] == 50) Cukup @elseif($nilai[2]['nilai'] == 25) Kurang @elseif($nilai[2]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[2]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Penguasaan Pekerjaan</td>
                        <td>@if($nilai[3]['nilai'] == 100) Sangat Baiik @elseif($nilai[3]['nilai'] == 75) Baik @elseif($nilai[3]['nilai'] == 50) Cukup @elseif($nilai[3]['nilai'] == 25) Kurang @elseif($nilai[3]['nilai'] == 0) Sangat Kurang @endif</td>
                        <td>{{ $nilai[3]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Penghargaan dan Sanksi</td>
                        <td>@if($nilai[4]['nilai'] == 100) Penghargaan @elseif($nilai[4]['nilai'] == 75) None @elseif($nilai[4]['nilai'] == 50) SP1 @elseif($nilai[4]['nilai'] == 25) SP2 @elseif($nilai[4]['nilai'] == 0) SP3 @endif</td>
                        <td>{{ $nilai[4]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Usia</td>
                        <td>{{ $karyawan->umur }}</td>
                        <td>{{ $nilai[5]['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Nilai Akhir</strong></td>
                        <td>{{ round($smartMethod->nilai, 2) * 100 }}%</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Keputusan :</strong> <span class="float-right">@if(round($smartMethod->nilai, 2) * 100 > 60) Rekomendasi Diterima/<strike>Tidak Direkomendasikan</strike> @else <strike>Rekomendasi Diterima</strike>/Tidak Direkomendasikan @endif</span></td>
                    </tr>
                </tbody>
            </table><br>
  
    </div>
    </div>
    *Keterangan :<br>
    <style>
    .tengah , th {
        text-align:center;
        vertical-align:middle;
    }
    </style>
    <table class="table table-striped table-bordered tengah" width="100%">
      <thead>
        <tr>
            <th>NO</th>
            <th>Rekomendasi Keputusan</th>
            <th>Nilai Akhir</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
            <td>Rekomendasi Perpanjang Kontrak</td>
            <td>60% - 100%</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Putus Kontrak</td>
            <td>0% - 59%</td>
        </tr>
      </tbody>


    </table>
  
      <div class="box box-primary">
    </div>
  
  
    <Br><br>
    <div style="float:right">
    &nbsp;&nbsp;&nbsp; Balaraja, {{ date('d F Y') }}<br><Br><Br><Br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(____________________)</div>
  
  
  
    </div>
@endsection