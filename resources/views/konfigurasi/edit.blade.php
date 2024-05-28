<form action="/konfigurasi/update" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmCabangedit">
    @csrf
    <div class="mb-3">
    <input type="hidden" class="form-control"  value="{{$jamkerja->id}}" readonly  name="id" placeholder="Kode Jam Kerja" id="id" >
    </div>
    <div class="mb-3">
      <label class="form-label">Kode Jam Kerja</label>
      <input type="text" class="form-control" value="{{$jamkerja->kode_jam_kerja}}" readonly  name="kode_jam_kerja" placeholder="Kode Jam Kerja" id="kode_jam_kerja" >
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Jam Kerja</label>
      <input type="text" class="form-control" name="nama_jam_kerja" value="{{$jamkerja->nama_jam_kerja}}" placeholder="Nama Jam Kerja" id="nama_jam_kerja" required >
    </div>
    <div class="mb-3">
      <label class="form-label">Awal Masuk Jam Kerja</label>
      <input type="time" class="form-control" name="awal_jam_masuk" value="{{ $jamkerja->awal_jam_masuk}}" placeholder="Awal Masuk Jam Kerja" id="awal_jam_masuk"  required> 
    </div>
    <div class="mb-3">
      <label class="form-label">Jam Masuk Kerja</label>
      <input type="time" class="form-control" name="jam_masuk" value="{{ $jamkerja->jam_masuk}}"   placeholder="Jam Masuk Kerja" id="jam_masuk" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Akhir Jam Masuk Kerja</label>
      <input type="time" class="form-control" name="akhir_jam_masuk" value="{{ $jamkerja->akhir_jam_masuk}}" placeholder="Akhir Jam Masuk Kerja" id="akhir_jam_masuk" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jam Pulang</label>
      <input type="time" class="form-control" name="jam_pulang" value="{{ $jamkerja->jam_pulang}}" placeholder="Jam Pulang" id="jam_pulang" required>
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
         var kode_jam_kerja       = $("#kode_jam_kerja").val();
         var nama_jam_kerja       = $("#nama_jam_kerja").val();
         var awal_jam_masuk       = $("#awal_jam_masuk").val();
         var jam_masuk            = $("#jam_masuk").val();
         var akhir_jam_masuk      = $("#akhir_jam_masuk").val();
         var jam_pulang           = $("#jam_pulang").val();
        
         if (kode_jam_kerja == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Kode Jam Kerja Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#kode_jam_kerja").focus();
           });
           return false;
         }else if (nama_jam_kerja == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Nama Jam Kerja Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#nama_jam_kerja").focus();
           });
           return false;
         }else if (awal_jam_masuk == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Awal Jam Masuk Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#awal_jam_masuk").focus();
           });
           return false;
         }else if (jam_masuk == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Jam Masuk Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#jam_masuk").focus();
           });
           return false;
         }else if (akhir_jam_masuk == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Akhir Masuk Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#akhir_jam_masuk").focus();
           });
           return false;
         }else if (jam_pulang == ""){
           Swal.fire({
            title: 'Warning!',
            text: 'Jam Pulang Harus Diisi',
            icon: 'warning',
            confirmButtonText: 'Ok',
           }).then((result) =>{
            $("#jam_pulang").focus();
           });
           return false;
         }
      });
  
}
</script>