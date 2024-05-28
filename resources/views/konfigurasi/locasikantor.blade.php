@extends('layouts.admin.indexadminlte') 

@section('contentadmin')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Konfigurasi Lokasi</h1>
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
    <h3 class="card-title">Konfigurasi Lokasi</h3>

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
    @if (Session::get('success'))
      <div class="alert alert-success">
          {{ Session::get('success')}}
      </div>
      @endif
      @if (Session::get('warning'))
      <div class="alert alert-warning">
          {{ Session::get('warning')}}
      </div>
      @endif
    <div class="row">
        <div class="col-md-6">
            <form action="/konfigurasi/updatelokasikantor" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Lokasi Kantor</label>
                    <input type="text" class="form-control" id="lokasi_kantor" name="lokasi_kantor" aria-describedby="emailHelp" placeholder="Lokasi Kantor" value="{{ $lok_kantor->lokasi_kantor}}">
                   
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Radius Kantor</label>
                    <input type="text" class="form-control" id="radius" name="radius" aria-describedby="emailHelp" placeholder="radius" value="{{ $lok_kantor->radius}}">
                   
                </div>
                <div class="form-group">
                     <button type="submit" class="btn btn-primary w-100">Update</button>
                </div>
            </form>
        </div>
    <!-- /.row -->
    </div>
    <!-- /.card-body -->
    
</div>


@endsection