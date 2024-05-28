<form action="/cabang/update" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmCabangedit">
    @csrf
    <div class="mb-3">
    <input type="hidden" class="form-control" value="{{ $cabang->id}}" readonly name="kode_cabang" placeholder="Kode Cabang" id="id" >
        <label class="form-label">Kode Cabang</label>
        <input type="text" class="form-control" value="{{ $cabang->kode_cabang}}" readonly name="kode_cabang" placeholder="Kode Cabang" id="kode_cabang" >
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Cabang</label>
        <input type="text" class="form-control" value="{{ $cabang->nama_cabang}}" name="nama_cabang" placeholder="Nama Cabang" id="nama_cabang" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi Cabang</label>
        <input type="text" class="form-control" value="{{ $cabang->lokasi_kantor}}" name="lokasi_kantor" placeholder="Lokasi Cabang" id="lokasi_kantor" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Radius Cabang</label>
        <input type="text" class="form-control" value="{{ $cabang->radius}}" name="radius" placeholder="Radius Cabang" id="radius" required >
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
    $("#frmCabangedit").submit(function() {
         var kode_cabang = $("#frmCabangedit").find("#kode_cabang").val();
         var nama_cabang = $("#frmCabangedit").find("#nama_cabang").val();
         var lokasi_kantor = $("#frmCabangedit").find("#lokasi_kantor").val();
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
}
</script>