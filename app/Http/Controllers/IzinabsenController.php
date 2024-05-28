<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IzinabsenController extends Controller
{
    public function create(){
        return view('izin.create');
    }

    public function store(Request $request){
        //return view('presensi.buatizin');
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari     = $request->tgl_izin_dari;
        $tgl_izin_sampai   = $request->tgl_izin_sampai;
        $status     = "i";
        $keterangan = $request->keterangan;

        $data = [
            'nik'        => $nik,
            'tgl_izin_dari'   => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status'     => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan) {
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        }else {
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }
    }

    public function edit($kode_izin) {
        $dataizin = DB::table('pengajuan_izin')->where('id', $kode_izin)->first();
        return view('izin.edit',compact('dataizin'));
    }

} 
   