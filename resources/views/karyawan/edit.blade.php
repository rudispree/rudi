<form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" enctype="multipart/form-data" style="margin-top:1rem" id="frmKaryawan">
                
           
             
              
            @csrf
                <div class="mb-3">
                    <label class="form-label">Nik</label>
                    <input type="number" class="form-control" name="nik" value="{{$karyawan->nik}}" placeholder="Nama Lengkap" id="nik" required disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap"  value="{{$karyawan->nama_lengkap}}" id="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" value="{{$karyawan->jabatan}}" id="jabatan" placeholder="Jabatan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Hp</label>
                    <input type="number" class="form-control" name="no_hp" value="{{$karyawan->no_hp}}" id="no_hp" placeholder="No Hp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Karyawan</label>
                    <input type="file" class="form-control" name="foto" id="foto" placeholder="Jabatan">
                    <input type="hidden" class="form-control" name="old_foto" value="{{$karyawan->foto}}" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="kode_dept" id="kode_dept" class="form-control" required>
                    <option>Departemen</option>
                    @foreach ($departemen as $d)
                    <option {{ $karyawan->kode_dept==$d->kode_dept ? 'selected' : '' }} value="{{$d->kode_dept}}">{{$d->nama_dept}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label for="exampleFormControlSelect1">Cabang</label>
                <select class="form-control" name="kode_cabang" id="kode_cabang" required id="exampleFormControlSelect1">
                    <option>Cabang</option>
                    @foreach ($cabang as $d)
                    <option {{ $karyawan->kode_cabang == $d->kode_cabang ? 'selected' : '' }} value="{{$d->kode_cabang}}">{{$d->nama_cabang}}</option>
                    @endforeach
                </select>
                </div>
                </div>

                <div class="modal-footer">
                <button  class="btn btn-primary btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                    <path d="M16 5l3 3"></path>
                </svg>
                Update Data
                </button>
                </div>
            </form>