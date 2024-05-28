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
           
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="card">
              <div class="card-header">
                <div class="col-sm-6">
                    <h3>Data Jam Kerja Karyawan</h3>
                </div> 
              </div>
              <!-- /.card-header -->
            <div class="row">
                <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Nik</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $karyawan->nik}}</li>
                    </ol>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Nama Karyawan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $karyawan->nama_lengkap}}</li>
                    </ol>
                </nav>
                </div>
            </div>
            
            <!--  -->
            <div class="row">
                <div class="col-4">
                  <form action="/konfigurasi/storejamkerja" method="POST">
                  <input type="hidden" name="nik" value="{{ $karyawan->nik}}">
                    @csrf
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Kerja</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Senin  <input type="hidden" name="hari[]" value="senin"></td>
                           
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Selasa <input type="hidden" name="hari[]" value="Selasa"></td>
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Rabu <input type="hidden" name="hari[]" value="Rabu"></td>
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Kamis <input type="hidden" name="hari[]" value="Kamis"></td>
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Jumat  <input type="hidden" name="hari[]" value="Jumat"></td>
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Sabtu <input type="hidden" name="hari[]" value="Sabtu"></td>
                            <td>
                                <select class="form-control" id="kode_jam_kerja" name="kode_jam_kerja[]">
                                  <option>Pilih Jam Kerja</option>
                                  @foreach($jamkerja as $d)
                                      <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                                  @endforeach
                                
                                
                                </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button type="submit" class="btn btn-primary w-100">Simpan</button>
                  </form>
                </div>
                <div class="col-8">
                <table class="table">
                    <thead>
                      <tr>
                        <th colspan="6"class="text-center">Master Jam Kerja</th>
                      </tr>
                      <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Awal Masuk</th>
                          <th>Jam Masuk</th>
                          <th>Akhir Jam Masuk</th>
                          <th>Jam Pulang</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($jamkerja as $d)
                      <tr>
                            <td>{{$d->kode_jam_kerja}}</td>
                            <td>{{$d->nama_jam_kerja}}</td>
                            <td>{{$d->awal_jam_masuk}}</td>
                            <td>{{$d->jam_masuk}}</td>
                            <td>{{$d->akhir_jam_masuk}}</td>
                            <td>{{$d->jam_pulang}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                   
                  </table>
                </div>
            </div>
            
</div>


@endsection