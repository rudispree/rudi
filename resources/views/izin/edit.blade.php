@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal {
        max-height:  430px !important;
    }
    .datepicker-date-display {
        background-color: #0f3a7e;
    }

</style>
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Edit Pengajuan Izin Sakit</div>
    <div class="right"></div>

</div>
@endsection

@section('content')
    <div class="row" style="margin-top:70px"> 
        <div class="col">
         
            <form method="post" action="/izinabsen/store" id="frmIzin">
                @csrf
                <div class="form-group">
                    <input type="text" id="tgl_izin_dari" value="{{ $dataizin->tgl_izin_dari }}" autocomplete="off" class="form-control datepicker" name="tgl_izin_dari" placeholder="Dari">
                 </div>
                 <div class="form-group">
                    <input type="text" id="tgl_izin_sampai" value="{{ $dataizin->tgl_izin_sampai }}"  class="form-control datepicker" name="tgl_izin_sampai" placeholder="Sampai">
                 </div>
                <div class="form-group">
                    <input type="text" id="jml_hari" class="form-control" name="jml_hari" placeholder="Jumlah Hari" readonly>
                 </div>
                <div class="form-group boxed">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"> {{$dataizin->keterangan}}</textarea>
                </div>
                <div class="form-group boxed">
                   <button class="btn btn-primary w-100" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
<script>
var currYear = (new Date()).getFullYear();

$(document).ready(function() {
  $(".datepicker").datepicker({
    //defaultDate: new Date(currYear-0,1,31),
    // setDefaultDate: new Date(2000,01,31),
    //maxDate: new Date(currYear-0,12,31),
    //yearRange: [2020, currYear-0],
    format: "yyyy-mm-dd"    
  });

  function loadjumlahhari() {
    var dari = $("#tgl_izin_dari").val();
    var sampai = $("#tgl_izin_sampai").val();
    var date1  = new Date(dari);
    var date2 = new Date(sampai);

    var Difference_In_Time = date2.getTime() - date1.getTime();

    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

    if (dari == "" || sampai == "") {
        var jmlhari = 0;
    }else {
        var jmlhari = Difference_In_Days + 1;
    }
    
    $("#jml_hari").val(jmlhari + " Hari");


  }

  loadjumlahhari();
  $("#tgl_izin_dari,#tgl_izin_sampai").change(function(e){
    loadjumlahhari();
  });

//   $("#tgl_izin").change(function(e) {
//     var tgl_izin = $(this).val();
//     //alert(tgl_izin);
//     $.ajax({
//         type: "POST",
//         url: '/presensi/cekpengajuanizin',
//         data: {
//             _token: "{{ csrf_token() }}",
//             tgl_izin: tgl_izin
//         },
//         cache:false,
//         success: function(respond) {
//                 if (respond == 1) {
//                     Swal.fire({
//                         title: 'Oops !',
//                         text: 'Anda Sudah Melakukan Input Pengajuan Izin Pada Tanggal Tersebut !',
//                         icon: 'warning'
//                     }).then(result => {
//                         $("#tgl_izin").val("");
//                     });
//                 }
//         }
//     });
//   });

  $("#frmIzin").submit(function(){
     var tgl_izin_dari     = $("#tgl_izin_dari").val(); 
     var tgl_izin_sampai   = $("#tgl_izin_sampai").val(); 
    
     var keterangan = $("#keterangan").val();

     if(tgl_izin_dari == "" || tgl_izin_sampai == "") {
        // alert('Tanggal Harus Diisi');
        Swal.fire({
            title: 'Oops !',
            text: 'Tanggal Harus Diisi',
            icon: 'warning'
        });
        return false;
     }else if (keterangan== ""){
        Swal.fire({
            title: 'Oops !',
            text: 'Keterangan Harus Diisi',
            icon: 'warning'
        });
        return false;
     }
  })
});




</script>
@endpush