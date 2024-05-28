<?php

namespace App\Http\Controllers;

use App\Models\Setjamkerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
   public function locasikantor() {
    $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
    return view('konfigurasi.locasikantor',compact('lok_kantor'));
   }

   public function updatelokasikantor(Request $request) {
         $lokasi_kantor =  $request->lokasi_kantor;
         $radius = $request->radius;
         $update = DB::table('konfigurasi_lokasi')->where('id',1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
         ]);
         if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
         } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
         }
   }


   public function jamkerja(){
      $jam_kerja = DB::table('jam_kerja')->orderBy('kode_jam_kerja')->get();
      return view('konfigurasi.jamkerja',compact('jam_kerja'));
   }

   public function store(Request $request)
   {
       $kode_jam_kerja	   = $request->kode_jam_kerja	;
       $nama_jam_kerja	   = $request->nama_jam_kerja;
       $awal_jam_masuk     = $request->awal_jam_masuk;
       $jam_masuk          = $request->jam_masuk;
       $akhir_jam_masuk	   = $request->akhir_jam_masuk;
       $jam_pulang         = $request->jam_pulang;

       try {
           $data = [
               'kode_jam_kerja'     => $kode_jam_kerja,
               'nama_jam_kerja'     => $nama_jam_kerja,
               'awal_jam_masuk'     => $awal_jam_masuk,
               'jam_masuk'          => $jam_masuk,
               'akhir_jam_masuk'    => $akhir_jam_masuk,
               'jam_pulang'         => $jam_pulang,
           ];
           DB::table('jam_kerja')->insert($data);

           
           return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
       } catch (\Exception $e) {
           return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
       }
   }

   public function update(Request $request)
   {
       $id            = $request->id;
       $kode_jam_kerja	   = $request->kode_jam_kerja	;
       $nama_jam_kerja	   = $request->nama_jam_kerja;
       $awal_jam_masuk     = $request->awal_jam_masuk;
       $jam_masuk          = $request->jam_masuk;
       $akhir_jam_masuk	   = $request->akhir_jam_masuk;
       $jam_pulang         = $request->jam_pulang;

       try {
           $data = [
            'kode_jam_kerja'     => $kode_jam_kerja,
            'nama_jam_kerja'     => $nama_jam_kerja,
            'awal_jam_masuk'     => $awal_jam_masuk,
            'jam_masuk'          => $jam_masuk,
            'akhir_jam_masuk'    => $akhir_jam_masuk,
            'jam_pulang'         => $jam_pulang,
           ];
           DB::table('jam_kerja')->where('kode_jam_kerja',$kode_jam_kerja)->update($data);

           
           return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
       } catch (\Exception $e) {
           return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
       }
   }

   public function edit(Request $request)
    {
        $kode_jam_kerja	 = $request->kode_jam_kerja	;
        $jamkerja       = DB::table('jam_kerja')->where('id', $kode_jam_kerja)->first();
     
        return view('konfigurasi.edit', compact('jamkerja'));
    }

    
   

    public function delete ($id) {
      $delete = DB::table('jam_kerja')->where('id', $id)->delete();
      if ($delete) {
          return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
      }else {
          return Redirect::back()->with(['warning' => 'Data Gagal Di hapus']);
      }
    }

    public function setjamkerja($nik)
    {
        $karyawan  = DB::table('karyawans')->where('nik', $nik)->first();
        $jamkerja  = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        $cekjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->count();
        // dd($cekjamkerja);
        if($cekjamkerja > 0) {
            $setjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->get();
            return view('konfigurasi.editjamkerja', compact('karyawan','jamkerja','setjamkerja'));
        }else {
            return view('konfigurasi.setjamkerja', compact('karyawan','jamkerja'));
        }

        
    }


    public function storejamkerja(Request $request)
    {
        $nik  = $request->nik;
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;

        for ($i = 0; $i < count($hari); $i++) {
            $data[] = [
                'nik' => $nik,
                'hari' => $hari[$i],
                'kode_jam_kerja' => $kode_jam_kerja[$i]
            ];
        }

        try {
            Setjamkerja::insert($data);
            // echo "Suksess";
            return Redirect('/karyawan')->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect('/karyawan')->with(['success' => 'Data Gagal Disimpan']);
        }
        // dd($kode_jam_kerja);
    }

    public function updatesetjamkerja(Request $request)
    {
        $nik  = $request->nik;
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;

        for ($i = 0; $i < count($hari); $i++) {
            $data[] = [
                'nik' => $nik,
                'hari' => $hari[$i],
                'kode_jam_kerja' => $kode_jam_kerja[$i]
            ];
        }

        DB::beginTransaction();
        // sebelum di hapus datanya jika ada error saat insert maka pakai data lama

        try {
            DB::table('konfigurasi_jamkerja')->where('nik',$nik)->delete();
            Setjamkerja::insert($data);
            // supaya data tersimpan maka gunakan perintah di bawah
            DB::commit();
            // echo "Suksess";
            return Redirect('/karyawan')->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect('/karyawan')->with(['success' => 'Data Gagal Disimpan']);
        }
        // dd($kode_jam_kerja);
    }
}
