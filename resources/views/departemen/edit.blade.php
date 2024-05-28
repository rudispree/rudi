<form action="/departemen/{{$departemen->id}}/update" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmDepartemen">
          @csrf
            <div class="mb-3">
              <label class="form-label">Kode Departemen</label>
              <input type="text" class="form-control" name="kode_dept" placeholder="Kode Departemen" id="kode_dept" value="{{$departemen->kode_dept}}"  required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Departemen</label>
              <input type="text" class="form-control" name="nama_dept" value="{{$departemen->nama_dept}}" placeholder="Nama Departemen" id="nama_dept" required>
            </div>
            
            <div class="modal-footer">
              <button  class="btn btn-primary btn-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              update Data
              </button>
            </div>
</form> 