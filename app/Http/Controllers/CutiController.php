<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = DB::table('master_cuti')->orderBy('kode_cuti', 'asc')->get();
        return view('cuti.index',compact('cuti'));
    }

    public function store(Request $request)
    {
        $nama_cuti          = $request->nama_cuti;
        $jml_hari           = $request->jml_hari;
        $tgl_izin_dari      = $request->tgl_izin_dari;
        $tgl_izin_sampai    = $request->tgl_izin_sampai;
       

        try {
            $data = [
                'nama_cuti'        => $nama_cuti,
                'jml_hari'         => $jml_hari,
                'tgl_izin_dari'    => $tgl_izin_dari,
                'tgl_izin_sampai'  => $tgl_izin_sampai,
            ];
            DB::table('master_cuti')->insert($data);

            
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function delete ($id) {
        $delete = DB::table('master_cuti')->where('kode_cuti', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di hapus']);
        }
    }

    public function edit(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $cuti      = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->first();
        return view('cuti.edit', compact('cuti'));
    }
    
    public function update(Request $request)
    {
        $kode_cuti          = $request->kode_cuti;
        $nama_cuti          = $request->nama_cuti;
        $jml_hari           = $request->jml_hari;
        $tgl_izin_dari      = $request->tgl_izin_dari;
        $tgl_izin_sampai    = $request->tgl_izin_sampai;
 
        try {
            $data = [
             'kode_cuti'     => $kode_cuti,
             'nama_cuti'        => $nama_cuti,
             'jml_hari'         => $jml_hari,
             'tgl_izin_dari'    => $tgl_izin_dari,
             'tgl_izin_sampai'  => $tgl_izin_sampai,
            ];
            DB::table('master_cuti')->where('kode_cuti',$kode_cuti)->update($data);
 
            
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

}
 