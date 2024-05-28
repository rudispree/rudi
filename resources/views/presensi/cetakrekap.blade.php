<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
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
    border-collapse:collapse;
  }
  .tabelpresensi tr th {
    border:1px solid #131212;
    padding: 8px;
    background-color: #dbdbdb;
  }
  .sizetanggal{
    font-size:8px !important;
    width:400px !important;
  }
  .tabelpresensi tr td {
    border:1px solid #131212;
    padding: 5px;
    background-color: #dbdbdb;
  }
  .top{
    margin-top:20px;
  }

  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
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
                    REKAP PRESENSI KARYAWAYAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{$tahun}}<br>
                    LSP DIGITAL MARKETING
                </span>
                <br>
                <hr>
                    <!-- <span class="topalamat">Ruko Fifth Avenue 5 No. 12 Paramount <br>Jl. Boulevard Raya Gading Serpong Kel. Pakulonan Barat, Kec. Kelapa Dua, Tangerang Banten 15810</span> -->
            </td>
        </tr>

    </table>

   
    <table class="tabelpresensi">
      <tr>
         <th rowspan="2">Nik.</th>
         <th rowspan="2">Nama</th>
         <th colspan="31">Tanggal</th>
         <th rowspan="2">TH</th>
         <th rowspan="2">TT</th>
      </tr>
      <tr>
          <?php 
             for($i=1; $i <= 31; $i++) {
             ?>
             <th class="sizetanggal">{{ $i }}</th>
             <?php
             }
             ?>   
             
      </tr>
      @foreach($rekap as $d)
      <tr>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }} </td>

            <?php 
                $totalhadir = 0;
                $totalterlambat = 0;
                for($i=1; $i<=31; $i++){
                    $tgl = "tgl_".$i;

                    if(empty($d->$tgl)){
                       $hadir = ['',''];
                       $totalhadir += 0;
                    }else {
                      $hadir = explode("_",$d->$tgl);
                      $totalhadir += 1;
                      if($hadir[0] > $d->jam_masuk){
                        $totalterlambat +=1;
                       }

                    }
                    
            ?>
            <td  class="sizetanggal">
              <span style="color:{{ $hadir[0]> $d->jam_masuk ? "red" : "" }}">{{ !empty($hadir[0]) ? $hadir[0] : '-'}}</span><br>
              <span style="color:{{ $hadir[1]< $d->jam_pulang ? "red" : "" }}">{{ !empty($hadir[1]) ? $hadir[1] : '-'}}</span><br>
              
            
            </td>
            <?php 
            }
            ?>
            <td>
                {{ $totalhadir; }}
            </td>
            <td>
                {{ $totalterlambat; }}
            </td>
           

      <tr>
      @endforeach
      
    </table>

    <table width="100%" style="margin-top:20px">
      <tr>
          <td></td>
          <td style="text-align: center">Tangerang, {{ date('d-m-Y') }}</td>
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