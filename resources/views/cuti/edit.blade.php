<form action="/cuti/update" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmCutiEdit">
    @csrf
    <div class="mb-3">
    <input type="hidden" class="form-control" value="{{ $cuti->kode_cuti}}" readonly name="kode_cuti" placeholder="Kode Cuti" id="kode_cuti" >
        
    <div class="mb-3">
        <label class="form-label">Nama Cuti</label>
        <input type="text" class="form-control" value="{{ $cuti->nama_cuti}}" name="nama_cuti" placeholder="Nama Cuti" id="nama_cuti" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Hari</label>
        <input type="text" class="form-control" value="{{ $cuti->jml_hari}}" name="jml_hari" placeholder="Jumlah Hari" id="jml_hari" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Izin Dari</label>
        <input type="text" class="form-control" value="{{ $cuti->tgl_izin_dari}}" name="tgl_izin_dari" placeholder="Tanggal Izin Dari" id="tgl_izin_dari" required >
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Izin Sampai</label>
        <input type="text" class="form-control" value="{{ $cuti->tgl_izin_sampai}}" name="tgl_izin_sampai" placeholder="Tanggal Izin Sampai" id="tgl_izin_sampai" required >
    </div>
    <div class="modal-footer">
        <button  class="btn btn-primary btn-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Update Data
        </button>
    </div>
</form>

<script>
$function() {
    $("#frmCutiEdit").submit(function() {
         var nama_cuti = $("#frmCutiEdit").find("#nama_cuti").val();
         var jml_hari = $("#frmCutiEdit").find("#jml_hari").val();
         var tgl_izin_dari = $("#frmCutiEdit").find("#tgl_izin_dari").val();
         var tgl_izin_sampai = $("#tgl_izin_sampai").val();
        
         if (nama_cuti == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Nama Cuti Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#nama_cuti").focus();
           });
           return false;
         }else if (jml_hari == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Jumlah Hari Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#jml_hari").focus();
           });
           return false;
         }else if (tgl_izin_dari == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Tanggal Izin Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#tgl_izin_dari").focus();
           });
           return false;
         }else if (tgl_izin_sampai == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Tanggal Izin Sampai Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#tgl_izin_sampai").focus();
           });
           return false;
         }
      });
}
</script>