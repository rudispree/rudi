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
                <h3 class="card-title">
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btnTambahDepartemen">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                    Tambah Data Departemen
                  </a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class=" table-responsive">
                  <form action="/departemen" method="GET">
                      <div class="row" style="margin-bottom:10px; margin-top:10px; margin-lef:2px;">
                          <div class="col-10">
                              <div class="form-group">
                                  <input type="text" name="nama_dept" id="nama_dept" class="form-control" placeholder="Data Departemen" value="{{ Request('nama_dept')}}">
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
                      <th>Kode Dept</th>
                      <th>Nama Department</th>
                      <th>Aksi</th>
                      </tr>
                  </thead>
                 <tbody>
                      @foreach ($departemen as $d)
                      <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$d->kode_dept}}</td>
                          <td>{{$d->nama_dept}}</td>
                          <td>
                              <a href="#" kode_dept="{{$d->kode_dept}}" class="edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                                </svg>
                              </a>

                              <form action="/departemen/{{ $d->id }}/delete" method="POST" enctype="multipart/form-data">
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
                     
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Departemen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <div class="modal-body">
          <form action="/departemen/store" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmKaryawan">
          @csrf
            <div class="mb-3">
              <label class="form-label">Kode Departemen</label>
              <input type="text" class="form-control" name="kode_dept" placeholder="Kode Departemen" id="kode_dept" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Departemen</label>
              <input type="text" class="form-control" name="nama_dept" placeholder="Nama Departemen" id="nama_dept" required>
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

<div class="modal modal-blur fade" id="modal-editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
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
      // $("#btnTambahkaryawan").click(function(){
      //     alert('test');
      // });

      $(".edit").click(function(){
          var kode_dept = $(this).attr('kode_dept');
          $.ajax({
            type: "POST",
            url: '/departemen/edit',
            cache: false,
            data: {
              _token: "{{ csrf_token(); }}",
              kode_dept: kode_dept
            },
            success: function(respond) {
              $("#loadeditform").html(respond);
            }
          });
          $("#modal-editdepartemen").modal('show');
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