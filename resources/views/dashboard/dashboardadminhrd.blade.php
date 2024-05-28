@extends('layouts.admin.indexadminlte') 

@section('contentadmin')

<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$rekappresensi->jmlhadir}}</h3>
                <p>Karyawan Hadir</p>
              </div>
              <div class="icon">
              <i class="fa fa-address-book text-white" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$rekappresensi->jmlterlambat}}</h3>

                <p>Karyawan Terlambat</p>
              </div>
              <div class="icon"> 
              <i class="fa fa-clock-o text-white" aria-hidden="true"></i>
              
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="text-white"> {{$rekapizin->jmlizin !== null ? $rekapizin->jmlizin : 0}}</h3>

                <p class="text-white">Karyawan Izin</p>
              </div>
              <div class="icon">
              <i class="fa fa-list-alt text-white" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer text-white">More info <i class="fa fa-arrow-right  text-white" aria-hidden="true"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$rekapizin->jmlsakit !== null ? $rekapizin->jmlsakit : 0}}</h3>

                <p> Karyawan Sakit</p>
              </div>
              <div class="icon">
              <i class="fa fa-bed text-white" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <!-- ./col -->
</div>

@endsection