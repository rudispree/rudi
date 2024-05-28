<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    // public function index(){
    //     $departemen = DB::table('departemen')->orderBy('kode_dept')->get();
    //     return view('departemen.index', compact('departemen'));
    // }
    public function index(Request $request){
       
       $nama_dept  = $request->nama_dept;
       $query      = Departemen::query();
       $query->select('*');
       if (!empty($nama_dept)) {
        $query->where('nama_dept', 'like', '%' .  $nama_dept . '%');
       }
       $departemen = $query->get();
        return view('departemen.index', compact('departemen'));
    }


    public function store(Request $request){
        $kode_dept = $request->kode_dept;
        $nama_dept = $request->nama_dept;
        $data = [
            'kode_dept' => $kode_dept,
            'nama_dept' => $nama_dept
        ];

        $cek = DB::table('departemen')->where('kode_dept', $kode_dept)->count();
        if($cek>0) {
             return Redirect::back()->with(['warning'=>'Data dengan Kode Dept '. $kode_dept. ' sudah ada']);
        }
        $simpan = DB::table('departemen')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $kode_dept = $request->kode_dept;
        $departemen = DB::table('departemen')->where('kode_dept', $kode_dept)->first();
        return view('departemen.edit', compact('departemen'));
    }

    public function update($id, Request $request) 
    {
        $kode_dept = $request->kode_dept;
        $nama_dept = $request->nama_dept;
  
        $data = [
            'kode_dept' => $kode_dept,
            'nama_dept' => $nama_dept
        ];
        $update = DB::table('departemen')->where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    
    public function delete ($id) {
        $delete = DB::table('departemen')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di hapus']);
        }
    }

}
