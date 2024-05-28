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
            <h1>Data Cabang</h1>
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
                <h3 class="card-title">
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btnTambahCabang">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                    Tambah Data Departemen
                  </a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class=" table-responsive">
                  <form action="/cabang" method="GET">
                      <div class="row" style="margin-bottom:10px; margin-top:10px; margin-lef:2px;">
                          <div class="col-10">
                              <div class="form-group">
                                  <select name="kode_cabang" class="form-control" id="">
                                        <option value="">Semua Cabang</option>
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
                      <th>Kode Cabang</th>
                      <th>Nama Cabang</th>
                      <th>Lokasi</th>
                      <th>Radius</th>
                      <th>Aksi</th>
                      </tr>
                  </thead>
                 <tbody>
                    
                 </tbody>
                      @foreach ($cabang as $d)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $d->kode_cabang }}</td>
                              <td>{{ $d->nama_cabang }}</td>
                              <td>{{ $d->lokasi_kantor }}</td>
                              <td>{{ $d->radius }} Meter</td>
                              <td>
                                  <a href="#" kode_cabang="{{$d->id}}" class="edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                    </svg>
                                  </a>

                                  <form action="/cabang/{{ $d->id }}/delete" method="POST" enctype="multipart/form-data">
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
                  </table>
                  <div style="margin-top:20px">
                     
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div class="modal fade" id="modal-inputcabang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Cabang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <div class="modal-body">
          <form action="/cabang/store" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmCabang">
          @csrf
            <div class="mb-3">
              <label class="form-label">Kode Cabang</label>
              <input type="text" class="form-control" name="kode_cabang" placeholder="Kode Cabang" id="kode_cabang" >
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Cabang</label>
              <input type="text" class="form-control" name="nama_cabang" placeholder="Nama Cabang" id="nama_cabang" >
            </div>
            <div class="mb-3">
              <label class="form-label">Lokasi Cabang</label>
              <input type="text" class="form-control" name="lokasi_kantor" placeholder="Lokasi Cabang" id="lokasi_kantor" >
            </div>
            <div class="mb-3">
              <label class="form-label">Radius Cabang</label>
              <input type="text" class="form-control" name="radius" placeholder="Radius Cabang" id="radius" >
            </div>
            <div class="modal-footer">
              <button  class="btn btn-primary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Simpan Data
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>


  <!-- edit -->

<div class="modal modal-blur fade" id="modal-editcabang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Cabang</h5>
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
      $("#btnTambahCabang").click(function(){
          $("#modal-inputcabang").modal("show");
      });

      $(".edit").click(function(){
          var kode_cabang = $(this).attr('kode_cabang');
          $.ajax({
            type: "POST",
            url: '/cabang/edit',
            cache: false,
            data: {
              _token: "{{ csrf_token(); }}",
              kode_cabang: kode_cabang
            },
            success: function(respond) {
              $("#loadeditform").html(respond);
            }
          });
          $("#modal-editcabang").modal('show');
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
      });


      $("#frmCabang").submit(function() {
         var kode_cabang = $("#kode_cabang").val();
         var nama_cabang = $("#nama_cabang").val();
         var lokasi_kantor = $("#lokasi_kantor").val();
         var radius = $("#radius").val();
        
         if (kode_cabang == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Kode Cabang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#kode_cabang").focus();
           });
           return false;
         }else if (nama_cabang == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Nama Cabang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#nama_cabang").focus();
           });
           return false;
         }else if (lokasi_kantor == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Lokasi Cabang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#lokasi_kantor").focus();
           });
           return false;
         }else if (radius == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Radius Kantor Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#radius").focus();
           });
           return false;
         }
      });
  
  });
  

 

</script>

@endpush