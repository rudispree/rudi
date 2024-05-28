<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { size: A4 }
  h3{}
  .topalamat{
    margin-top:-10px !important;
  }
  .laporan{
    font-size:16px;
    font-weight:bold;
  }
  .tabledatakaryawan{
    margin-top:20px !important; 
  }
  .tabledatakaryawan td{
    padding: 5px;

  }
  .tabelpresensi{
    width:100%;
    margin-top:20px;
  }
  .top{
    margin-top:20px;
  }
 .size{
  width:40px;
 }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
  <?php 
  function selisih($jam_masuk, $jam_keluar)
  {
      list($h, $m, $s) = explode(":", $jam_masuk);
      $dtAwal = mktime($h, $m, $s, "1", "1", "1");
      list($h, $m, $s) = explode(":", $jam_keluar);
      $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
      $dtSelisih = $dtAkhir - $dtAwal;
      $totalmenit = $dtSelisih / 60;
      $jam = explode(".", $totalmenit / 60);
      $sisamenit = ($totalmenit / 60) - $jam[0];
      $sisamenit2 = $sisamenit * 60;
      $jml_jam = $jam[0];
      return $jml_jam . ":" . round($sisamenit2);
  }
  ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width:40px">
                <img src="{{ asset('assets/img/logo.png') }}" width="110" height="70" alt="" />
            </td>
            <td>
                <span class="laporan">
                    LAPORAN PRESENSI KARYAWAYAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{$tahun}}<br>
                    LSP DIGITAL MARKETING
                </span>
                <br>
                <hr>
                    <!-- <span class="topalamat">Ruko Fifth Avenue 5 No. 12 Paramount <br>Jl. Boulevard Raya Gading Serpong Kel. Pakulonan Barat, Kec. Kelapa Dua, Tangerang Banten 15810</span> -->
            </td>
        </tr>

    </table>

    <table class="tabledatakaryawan" >
        <tr>
            <td rowspan="6" >
              @php
              $path  = Storage::url('uploads/karyawan/'.$karyawan->foto);
              @endphp
              <img src="{{ url($path) }}" alt="" width="200">
            </td>
        </tr>
        <tr>
            <td>Nik </td>
            <td>: </td>
            <td>{{ $karyawan->nik}} </td>
        </tr>
        <tr>
            <td>Nama Karyawan </td>
            <td>: </td>
            <td>{{ $karyawan->nama_lengkap}} </td>
        </tr>
        <tr>
            <td>Jabatan </td>
            <td>: </td>
            <td>{{ $karyawan->jabatan}} </td>
        </tr>
        <tr>
            <td>Departemen </td>
            <td>: </td>
            <td>{{ $karyawan->nama_dept}} </td>
        </tr>
        <tr>
            <td>No Hp</td>
            <td>: </td>
            <td>{{ $karyawan->no_hp}} </td>
        </tr>
    </table>
    <table class="table table-striped table-hover top">
      <tr>
         <th>No.</th>
         <th>Tanggal</th>
         <th>Jam Masuk</th>
         <th>Foto</th>
         <th>Jam Pulang</th>
         <th>Foto</th>
         <th>Keterangan</th>
         <th>Jumlah Jam Kerja Karyawan</th>
      </tr>
      <tbody>
        @foreach($presensi as $d)
        @php 
        $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
        $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
        $jamterlambat = selisih($d->jam_masuk,$d->jam_in);
        @endphp
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{ date("d-m-Y", strtotime($d->tgl_presensi))}}</td>
          <td>{{ $d->jam_in }}</td>
          <td><img src="{{ url($path_in) }}" class="img-responsive size"></td>
          <td>{{ $d->jam_out !== null ? $d->jam_out : 'Belum Absen'}}</td>
          <td>

           
            @if ($d->jam_out !== null)
              <img src="{{ url($path_out) }}" class="img-responsive size">
            @else
              <i class="fa fa-camera" aria-hidden="true"></i>
            @endif
          </td>
          <td>
              @if($d->jam_in > $d->jam_masuk)
              Terlambat {{ $jamterlambat}}
              @else
              Tepat Waktu
              @endif
          </td>
          <td>
            @if ($d->jam_out  !== null)
                @php 
                $jmljamkerja = selisih($d->jam_in,$d->jam_out);
                @endphp
                @else
                @php 
                $jmljamkerja = 0;
                @endphp
                @endif
                {{ $jmljamkerja }}
           
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <table width="100%" style="margin-top:20px">
      <tr>
          <td colspan="2" style="text-align:right">Tangerang, {{ date('d-m-Y') }}</td>
      </tr>
      <tr>
        <td style="text-align:center; vertical-align:bottom;" height="100px">
            <u>Firja</u><br>
            <i>HRD Manager</i>

        </td>
        <td style="text-align:center; vertical-align:bottom;" height="100px">
            <u>Nina</u><br>
            <i>Keuangan</i>

        </td>
      </tr>
    </table>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>