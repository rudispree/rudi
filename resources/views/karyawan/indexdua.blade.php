@extends('layouts.admin.indexadminlte') 

@section('contentadmin')
<style>
  .width{ 
    width:40px;
  }
</style>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
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
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3">
                      <h3 class="card-title">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                          Tambah Data Karyawan
                        </a>
                      </h3>
                  </div>
                  
                  <div class="col-md-3">
                      <form action="/karyawan/user-import" method="post" enctype="multipart/form-data">
                          @csrf 
                          <input type="file" name="file" class="form-control" accept=".doc, .docx,.xls,.xlsx,.pdf,.csv,">
                          <!-- <button class="btn btn-primary">Upload</button> -->
                     
                  </div>
                  <div class="col-2">
                              <div class="form-group">
                              <button class="btn btn-primary">Upload</button>
                              </div>
                        </form>
                  </div>
                  <div class="col-md-3">
                     <a href="/karyawan/user-export">
                          <button class="btn btn-primary">Expor Data Excel</button>
                     </a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class=" table-responsive">
                  <form action="/karyawan" method="GET">
                      <div class="row" style="margin-bottom:10px; margin-top:10px; margin-lef:2px;">
                          <div class="col-6">
                              <div class="form-group">
                                  <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Data Karyawan" value="{{ Request('nama_karyawan')}}">
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <select name="kode_dept" id="kode_dept" class="form-control">
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
                  <table class="table table-striped">
                  <thead>
                      <tr>
                      <th>No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>No. Hp</th>
                      <th>Foto</th>
                      <th>Departemen</th>
                      <th>Cabang</th>
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
                              <img src="https://i.ibb.co/wgQ5HSL/img-avatar.png" class="avatar img-circle elevation-2 width" alt="">
                              @else 
                              <img src="{{url($path)}}" class="avatar img-circle elevation-2 width" alt="">
                              @endif
                          </td> 
                          <td>
                              {{$d->nama_dept}}
                          </td> 
                          <td>
                              {{$d->kode_cabang}}
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

                            <a href="/konfigurasi/{{ $d->nik }}/setjamkerja"  >
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-automation" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                              <path d="M10 9v6l5 -3z"></path>
                              </svg>
                            </a>

                            <form action="/karyawan/{{ $d->nik }}/delete" method="POST" enctype="multipart/form-data">
                              @csrf
                              <!-- @method('DELETE') -->
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
              <!-- /.card-body -->
</div>

<!--  -->




    <!-- new modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
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
            <div class="form-group">
              <label for="exampleFormControlSelect1">Departemen</label>
              <select class="form-control" name="kode_dept" id="kode_dept" required id="exampleFormControlSelect1"> 
                <option>Departemen</option>
                  @foreach ($departemen as $d)
                  <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{$d->kode_dept}}">  {{$d->nama_dept}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Cabang</label>
              <select class="form-control" name="kode_cabang" id="kode_cabang" required id="exampleFormControlSelect1">
                <option>Cabang</option>
                  @foreach ($cabang as $d)
                  <option  value="{{$d->kode_cabang}}"> {{ strtoupper ($d->nama_cabang) }}</option>
                  @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <button  class="btn btn-primary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Simpan Data
              </button>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--  -->

    <!-- edit -->



<div class="modal fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadeditform">
      
      </div>
    
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
        var nik = $(this).attr("nik");
        $.ajax({
          type: "POST",
          url : '/karyawan/edit',
          cache: false,
          data: {
            _token: "{{ csrf_token();}}",
            nik: nik
          },
          success: function(respond){
            $("#loadeditform").html(respond);
          }
        })
        $("#modal-editkaryawan").modal('show');
      });

      $(".delete-confirm").click(function(e){
        // alert('test');
        var form = $(this).closest('form');
        e.preventDefault();
        Swal.fire({
          title: 'Apakah Anda yakin Data ini Mau di Hapus ?',
          text: "Jika Ya, Maka Data akan Terhapus Permanen",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
            Swal.fire(
              'Deleted!',
              'Data Berhasil Dihapus',
              'success'
            )
          }
        })
      })
  
  });
  

 

</script>

@endpush




