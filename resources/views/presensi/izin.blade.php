@extends('layouts.presensi')
@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Data Pengajuan Izin / Sakit </div>
    <div class="right"></div>

</div> 
@endsection

@section('content')
<div class="row" style="margin-top:70px;">
    <div class="col">
        @php
            $messagesuccess = Session::get('success');
            $messageerror   = Session::get('error');
        @endphp
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col"> 
    @foreach ($dataizin as $d)
        <!-- <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{ date("d-m-y",strtotime($d->tgl_izin_dari)) }} ({{$d->status== "s" ? "Sakit" : "Izin"}})</b><br>
                            <small class="text-muted">{{ $d->keterangan}}</small>
                        </div>
                        @if ($d->status_approved == 0)
                            <span class="badge bg-warning">Waiting</span>
                        @elseif ($d->status_approved == 1)
                             <span class="badge bg-success">Approved</span>
                        @elseif ($d->status_approved == 2)
                        <span class="badge bg-danger">Tidak Disetujui</span>
                        @endif
                    </div>
                </div>
            </li>
        </ul> -->
        <style>
            .historicontent{
                display: flex;
               
            }
            .datapresensi{
                margin-left:20px;
                line-height:1px;
            }
            .status{
                position: absolute;
                right: 20px;
            }
        </style>
       @php 
       if ($d->status =="i"){
        $status = "Izin";
       }else if ($d->status =="s"){
        $status = "Sakit";
       }else if ($d->status =="c"){
        $status = "Cuti";
       }else{
        $status = "Kasih Tahu G ya";
       }

       @endphp
        <div class="card card_izin" kode_izin="{{ $d->id }}" style="margin-top:10px;" data-toggle="modal" data-target="#actionSheetIconed">
            <div class="card-body"  >
                <div class="historicontent">
                    <div class="iconpresensi">
                    @if ($d->status =="i")
                    <ion-icon name="document-outline" style="font-size:48px; color:rgb(21,95,207)"></ion-icon>
                    @elseif($d->status =="s")
                    <ion-icon name="medkit-outline" style="font-size:48px; color:rgb(191,7,65)"></ion-icon>
                    @elseif($d->status =="c")
                    <ion-icon name="calendar-outline" style="font-size:48px; color:rgb(237, 128, 5)"></ion-icon>
                    @endif
                    </div>
                    <div class="datapresensi">
                    <h3 style="line-height:3px">
                    {{date("d-m-Y",strtotime($d->tgl_izin_dari))}} ({{$status}})
                    </h3>
                    <h5>{{date("d-m-y",strtotime($d->tgl_izin_dari))}} s/d {{date("d-m-y",strtotime($d->tgl_izin_sampai))}} </h5>
                    <p>
                        @if ($d->status=="c")
                        <span class="badge bg-warning">{{ $d->nama_cuti }}</span>
                        @endif
                    </p>
                    <p style="line-height:3px; margin-top:10px;">
                        {{$d->keterangan}}</p>
                    <p>
                        @if(!empty($d->doc_sid))
                        <span style="color:blue">
                        <ion-icon name="document-attach-outline"></ion-icon> Lihat SID
                        </span>
                        @endif
                    </p>

                    </div>
                   
                    <div class="status">
                    @if ($d->status_approved==0)
                        <span class="bg-warning badge" style="badge bg-warning">Pending</span>
                    @elseif($d->status_approved==1)
                        <span class="bg-primary badge" style="badge bg-success">Disetujui</span>
                    @elseif($d->status_approved==2)
                    <span class="bg-danger badge" style="badge bg-danger">Ditolak</span>
                    @endif
                    <p style="margin-top:5px; font-weight:bold;">{{hitunghari($d->tgl_izin_dari,$d->tgl_izin_sampai)}} Hari</p>
                    </div>
                    
                  
                    
                   
                </div>
                
            </div>
        </div>
     @endforeach

    </div>
</div>
<!-- <div class="fab-button bottom-right" style="margin-bottom:70px;">
    <a href="/presensi/buatizin" class="fab"><ion-icon name="add-outline"></ion-icon></a>
</div> -->

<div class="fab-button animate bottom-right dropdown" style="margin-bottom:70px">
    <a href="#" class="fab bg-primary" data-toggle="dropdown">
        <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline">
 
        </ion-icon>
    </a>
    <div class="dropdown-menu">
        <a href="/izinabsen" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="image outline">

            </ion-icon>
            <p>Izin Absen</p>
         </a>
         <a href="/izinsakit" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="videocam outline">

            </ion-icon>
            <p>Sakit</p>
         </a>
         <a href="/izincuti" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="image outline">

            </ion-icon>
            <p>Cuti</p>
         </a>
    </div>

    </div>

    <!-- Modal -->

    <div class="modal fade action-sheet" id="actionSheetIconed" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aksi</h5>
                </div>
                <div class="modal-body" id="showact">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
<script>
    $(function(){
        $(".card_izin").click(function(e){
            var kode_izin = $(this).attr("kode_izin");
            // alert(kode_izin);
            $("#showact").load('/izin/' + kode_izin + '/showact');
        });
    });

</script>
@endpush
