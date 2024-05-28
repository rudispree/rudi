<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IzincutiController extends Controller
{
    public function create(){

        $mastercuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        return view('izincuti.create', compact('mastercuti'));
    }

    public function store(Request $request){
        //return view('presensi.buatizin');
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari     = $request->tgl_izin_dari;
        $tgl_izin_sampai   = $request->tgl_izin_sampai;
        $kode_cuti_karyawan = $request->kode_cuti_karyawan;

        $status     = "c";
        $keterangan = $request->keterangan;

        $data = [
            'nik'        => $nik,
            'tgl_izin_dari'   => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status'     => $status,
            'keterangan' => $keterangan,
            'kode_cuti_karyawan' => $kode_cuti_karyawan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan) {
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        }else {
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }
    }
    
}
 