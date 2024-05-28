@extends('layouts.admin.tabler')

@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                 
                </div>
                <h2 class="page-title">
                  Data Karyawan
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                 
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block"  data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                    Tambah Data Karyawan
                  </a>

                  <a href="#" id="btnTambahkaryawan">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                    Tambah Data Karyawan dua
                  </a>
                 
                </div>
              </div>
            </div>
          </div>
</div>

<style>


</style>
<div class="container-xl">
<div class="page-body">
    <div class="col-12">
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
                    <div class="card">
                    <div class="table-responsive">
                        <form action="/karyawan" method="GET">
                            <div class="row" style="margin-bottom:10px; margin-top:10px; margin-lef:2px;">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Data Karyawan" value="{{ Request('nama_karyawan')}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <select name="kode_dept" id="kode_dept" class="form-select">
                                            <option>Departemen</option>
                                            @foreach ($departemen as $d)
                                            <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{$d->kode_dept}}">{{$d->nama_dept}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                        </svg>
                                        Cari Data
                                      </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No. Hp</th>
                            <th>Foto</th>
                            <th>Departemen</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach  ($karyawan as $d)
                            @php 
                            $path = Storage::url('uploads/karyawan/'.$d->foto);
                            @endphp
                            <tr>
                                <td>
                                    {{ $loop->iteration + $karyawan->firstItem() -1 }}
                                </td> 
                                <td>
                                    {{$d->nik}}
                                </td> 
                                <td>
                                    {{$d->nama_lengkap}}
                                </td> 
                                <td>
                                    {{$d->jabatan}}
                                </td> 
                                <td>
                                    {{$d->no_hp}}
                                </td> 
                                <td>
                                    @if(empty($d->foto))
                                    <img src="https://i.ibb.co/wgQ5HSL/img-avatar.png" class="avatar" alt="">
                                    @else 
                                    <img src="{{url($path)}}" class="avatar" alt="">
                                    @endif
                                </td> 
                                <td>
                                    {{$d->nama_dept}}
                                </td> 
                                <td>
                                  <!-- <a href="{{url('karyawan/editprofile')}}/{{$d->nik}}" nik="{{$d->nik}}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                  </svg>
                                  </a> -->
                                  <a href="#" class="edit" nik="{{$d->nik}}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                  </svg>
                                  </a>

                                  <form action="/karyawan/{{ $d->nik }}/delete">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-danger btn-sm delete-confirm" id="">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                                      </svg>
                                    </a>
                                  </form>
                                 
                                </td>   
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div style="margin-top:20px">

                        {{$karyawan->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                    </div>
    </div>
</div>
</div>
 
<!-- modal -->
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body">
          <form action="/karyawan/store" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmKaryawan">
          @csrf
          <div class="mb-3">
              <label class="form-label">Nik</label>
              <input type="number" class="form-control" name="nik" placeholder="Nama Lengkap" id="nik" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jabatan</label>
              <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" required>
            </div>
            <div class="mb-3">
              <label class="form-label">No. Hp</label>
              <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Jabatan" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Foto Karyawan</label>
              <input type="file" class="form-control" name="foto" id="foto" placeholder="Jabatan" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Departemen</label>
              <select name="kode_dept" id="kode_dept" class="form-select" required>
                <option>Departemen</option>
                @foreach ($departemen as $d)
                <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{$d->kode_dept}}">{{$d->nama_dept}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
          
            <button  class="btn btn-primary btn-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Simpan Data
            </button>
          </div>
          </form>
        </div>
      </div>
</div>
<!-- edit -->
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body" id="loadedtform">
         
        </div>
      </div>
</div>
        
        
@endsection


@push('myscript')

<script>
  $(function() {
      $("#btnTambahkaryawan").click(function(){
          alert('test');
      });
      
      $(".edit").click(function(){
        alert('test');
      })
  });
  

 

</script>

@endpush