@extends('layouts.admin.indexadminlte') 

@section('contentadmin')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Data Karyawan Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Karyawan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card card-default">
    <div class="card-header">
    <h3 class="card-title">Data Karyawan</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
    </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <div class="row">
        <!-- <div class="col-md-6">
            <form action="/presensi/cetaklaporan" id="frmLaporan" target="_blank" method="POST">
                @csrf
                <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" id="bulan"  class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Bulan</option>
                    @for ($i=1; $i <=12; $i++) 
                        <option value="{{$i}}" {{ date("m") == $i ? 'selected' : '' }}>{{ $namabulan[$i] }} </option>
                     @endfor
                  
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                                <option value="">Tahun</option>
                                @php
                                $tahunmulai = 2022;
                                $tahunskrg  = date("Y");
                                @endphp
                                @for ($tahun=$tahunmulai; $tahun<= $tahunskrg; $tahun++) <option value="{{$tahun}}" {{ date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                                @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <select  name="nik" id="nik"  class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Pilih Karyawan</option>
                    @foreach ($karyawan as $d)
                        <option value="{{ $d->nik }}">{{ $d->nama_lengkap }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" name="cetak" class="btn btn-primary btn-lg btn-block"><i class="fa fa-print" aria-hidden="true"></i> Cetak Data Karyawan</button>
                        </div>
                        
                    </div>
                        
                    
                </div>
            </form>
        </div> -->
        <div class="col-md-6">
            <form action="/presensi/cetaklaporankehadiran" method="POST">
                @csrf
                <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan"  class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Bulan</option>
                    @for ($i=1; $i <=12; $i++) 
                        <option value="{{$i}}" {{ date("m") == $i ? 'selected' : '' }}>{{ $namabulan[$i] }} </option>
                     @endfor
                  
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                                <option value="">Tahun</option>
                                @php
                                $tahunmulai = 2022;
                                $tahunskrg  = date("Y");
                                @endphp
                                @for ($tahun=$tahunmulai; $tahun<= $tahunskrg; $tahun++) <option value="{{$tahun}}" {{ date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                                @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <select  name="nik"  class="form-control select2bs4" style="width: 100%;">
                    <option selected="selected">Pilih Karyawan</option>
                    @foreach ($karyawan as $d)
                        <option value="{{ $d->nik }}">{{ $d->nama_lengkap }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                       
                        <div class="col-md-6">
                            <button  class="btn btn-success btn-lg btn-block"><i class="fa fa-download" aria-hidden="true"></i> Download Data</button>


                            
                        </div>
                    </div>
                        
                    
                </div>
            </form>
        </div>
    <!-- /.row -->
    </div>
    <!-- /.card-body -->
    
</div>


@endsection

@push('myscript')

<script>
    $(function(){
        $("#frmLaporan").submit(function(e) {
            
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            var nik   = $("#nik").val();

          

            if (bulan == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Bulan Harus Di Pilih',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    $("bulan").focus();
                });
            }
           
            return false;


        });
    });
</script>

@endpush