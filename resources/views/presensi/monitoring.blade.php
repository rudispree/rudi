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
            <h1>Monitoring Presensi</h1>
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



<div class="card">
              
              <div class="card-body">
              
                   <form action="/karyawan" method="GET">
                      <div class="row" style=" margin-top:5px; margin-lef:2px;">
                          <div class="col-12">
                           <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="tanggal" value="{{ date('Y-m-d') }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="Tanggal Presensi" autocomplete="off">
                            </div>
                          </div>
                          
                       
                      </div>
                    </form>
                 
              
              </div>
              <!-- /.card-body -->
</div>


<div class="card">
       
        <!-- /.card-header -->
        <div class="card-body">
        <div class=" table-responsive">
        <table class="table table-striped">
                  <thead>
                      <tr>
                      <th>No</th>
                      <th>Nik</th>
                      <th>Nama Karyawan</th>
                      <th>Departemen</th>
                      <th>Jadwal</th>
                      <th>Jam Masuk</th>
                      <th>Foto</th>
                      <th>Jam Pulang</th>
                      <th>Foto</th>
                      <th>Keterangan</th>
                      <th></th>
                      </tr>
                  </thead>
                  <tbody id="loadpresensi">
                     
                         
                  </tbody>
                 
                  </table>
          
        </div>
        </div>
        <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      

<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadmap">
      
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
      function loadpresensi(){
        var tanggal = $("#tanggal").val();
        // alert(tanggal);
        $.ajax({
          type: "POST",
          url : '/getpresensi',
          cache: false,
          data: {
            _token: "{{ csrf_token() }}",
            tanggal: tanggal
          },
          success: function(respond){
            $("#loadpresensi").html(respond);
          }
        });
      }
      $("#tanggal").change(function(e){
        loadpresensi();
      });
      
      loadpresensi();
  });
  

</script>


@endpush