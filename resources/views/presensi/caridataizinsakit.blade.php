@extends('layouts.admin.indexadminlte') 

@section('contentadmin')

<style>
  .width{
    width:40px;
  }
</style>
<section class="content-header">
      <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h2 class="page-title">
                        Data Izin / Sakit
                    </h2>
                </div>
            </div>
      </div>

</section>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Karyawan Yang Mengajukan Izin dan Sakit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-header">
              <form action="/presensi/caritanggal" method="POST" enctype="multipart/form" autocomplete="off">
              @csrf
                <div class="row">
                      <div class="col-6">
                          <div class="form-group">
                            <input type="text" id="dari"  name="dari" class="form-control"  placeholder="Dari" autocomplete="off" required>
                          </div>
                      </div>
                      <div class="col-6">
                      
                        <div class="form-group">
                          <input type="text" id="sampai"  name="sampai" class="form-control" data-inputmask-alias="datetime" placeholder="Sampai" autocomplete="off" required>
                        </div>
                        
                      </div>
                      <div class="col-3">
                       
                            <div class="form-group">
                              <input type="text" id="nik" name="nik" class="form-control" data-inputmask-alias="datetime" placeholder="Nik" autocomplete="off">
                            </div>
                       
                      </div>
                      <div class="col-3">
                       
                            <div class="form-group">
                              <input type="text" id="nama_karyawan" name="nama_lengkap" class="form-control" data-inputmask-alias="datetime" placeholder="Nama Karyawan" autocomplete="off">
                            </div>
                       
                      </div>
                      <div class="col-3">
                            <div class="form-group">
                              <select name="status_approved" class="form-control" id="status_approved">
                              <option value="">Pilih Status</option>
                              <option value="0">Pending</option>
                              <option value="1">Disetujui</option>
                              <option value="2">Ditolak</option>
                            </select>
                            </div>           
                      </div>
                      <div class="col-3">
                            <div class="form-group">
                              <button  type="submit" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> Cari </button>
                            </div>           
                      </div>
                </div>
              </form>
              </div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nik</th>
                        <th scope="col">Nama Karyawan</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Status Approved</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query as $d)
                        <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ date('d-m-Y',strtotime($d->tgl_izin)) }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ $d->nama_lengkap }}</td>
                        <td>{{ $d->jabatan }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>{{ $d->status == "i" ? "Izin" : "Sakit" }}</td>
                        <td>
                            @if ($d->status_approved==1)
                              <span class="badge bg-success">Disetujui</span>
                            @elseif ($d->status_approved==2)
                             <span class="badge bg-danger">Ditolak</span>
                            @else
                            <span class="badge bg-warning">Pending</span>
                            @endif

                        </td>
                        <td>
                          @if($d->status_approved==0)
                            <a href="#" class="btn btn-sm btn-primary approve" id="approve" id_izinsakit={{ $d->id }}>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                        
                          @else
                            <a href="/presensi/{{ $d->id }}/batalkanizinsakit" class="btn btn-sm btn-danger">
                            <i class="fa fa-step-backward" aria-hidden="true"></i>Batalkan
                            </a>
                          @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>



    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modal-izinsakit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form action="/presensi/approveizinsakit" method="post" enctype="multipart/form">
            @csrf
                  <input type="text" id="id_izinsakit_form" name="id_izinsakit_form">
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <select class="form-control" name="status_approved" id="status_approved">
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </div>
           </form>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="modal-izinsakit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form action="/presensi/approveizinsakit" method="post" enctype="multipart/form">
            @csrf
                  <input type="text" id="id_izinsakit_form" name="id_izinsakit_form">
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <select class="form-control" name="status_approved" id="status_approved">
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </div>
           </form>
      </div>
      
    </div>
  </div>
</div>



@endsection

@push('myscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
  
  $(function(){
      
      $(".approve").click(function(e){
        e.preventDefault();
        var id_izinsakit = $(this).attr("id_izinsakit");
        $("#id_izinsakit_form").val(id_izinsakit);
        // alert(id_izinsakit);
        $("#modal-izinsakit").modal("show");
      });

      $("#dari, #sampai").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });

    

      
  });
</script>

@endpush
