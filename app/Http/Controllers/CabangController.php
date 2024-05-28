<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = DB::table('cabang')->orderBy('kode_cabang','asc')->get();
        return view('cabang.index', compact('cabang'));
    }
 
    public function store(Request $request)
    {
        $kode_cabang   = $request->kode_cabang;
        $nama_cabang   = $request->nama_cabang;
        $lokasi_kantor = $request->lokasi_kantor;
        $radius        = $request->radius;

        try {
            $data = [
                'kode_cabang'   => $kode_cabang,
                'nama_cabang'   => $nama_cabang,
                'lokasi_kantor' => $lokasi_kantor,
                'radius'        => $radius,
            ];
            DB::table('cabang')->insert($data);

            
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }


    public function edit(Request $request)
    {
        $kode_cabang = $request->kode_cabang;
        $cabang      = DB::table('cabang')->where('id', $kode_cabang)->first();
        return view('cabang.edit', compact('cabang'));
    }

 
    public function update(Request $request)
    {
        $id            = $request->id;
        $kode_cabang   = $request->kode_cabang;
        $nama_cabang   = $request->nama_cabang;
        $lokasi_kantor = $request->lokasi_kantor;
        $radius        = $request->radius;

        try {
            $data = [
               
                'nama_cabang'   => $nama_cabang,
                'lokasi_kantor' => $lokasi_kantor,
                'radius'        => $radius,
            ];
            DB::table('cabang')->where('kode_cabang',$kode_cabang)->update($data);

            
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

    public function delete ($id) {
        $delete = DB::table('cabang')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di hapus']);
        }
    }
}
