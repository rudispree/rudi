<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\ToModel;


class KaryawanController extends Controller
{
    public function index(Request $request)
    {


        // $karyawan = DB::table('karyawans')->orderBy('nama_lengkap')
        // ->join('departemen','karyawans.kode_dept', '=', 'departemen.kode_dept')
        // ->paginate(2);


        $query = Karyawan::query();
        $query->select('karyawans.*', 'nama_dept');
        $query->join('departemen','karyawans.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }

        if(!empty($request->kode_dept)) {
            $query->where('karyawans.kode_dept', $request->kode_dept );
        }
 
        $karyawan = $query->paginate(10);

        $departemen = DB::table('departemen')->get();
        $cabang     = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('karyawan.indexdua',compact('karyawan','departemen','cabang'));
    }

    public function export(){
        return Excel::download(new KaryawanExport,'karyawan-excel.xlsx');
    }

    public function import(){
        $simpan = Excel::import(new KaryawanImport, request()->file('file'));
        
        //dd (Excel);
      
      
        if ($simpan) {
          
            return Redirect::back()->with(['success' => 'Data Berhsil Disimpan']);
           
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

   


    public function store (Request $request) {
            $nik = $request->nik;
            $nama_lengkap = $request->nama_lengkap;
            $jabatan      = $request->jabatan;
            $no_hp        = $request->no_hp;
            $kode_dept    = $request->kode_dept;
            $password     = Hash::make('12345');
            $kode_cabang  = $request->kode_cabang;
            $karyawan     = DB::table('karyawans')->where('nik',$nik)->first();
            if ($request->hasFile('foto')) {
                $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
            }else {
                //$foto = $karyawan->foto;
                $foto = null;
            }
            
            try {
                $data = [
                    'nik'          => $nik,
                    'nama_lengkap' => $nama_lengkap,
                    'jabatan'      => $jabatan,
                    'no_hp'        => $no_hp,
                    'kode_dept'    => $kode_dept,
                    'foto'         => $foto,
                    'password'     => $password,
                    'kode_cabang'  => $kode_cabang
                ];
                $simpan = DB::table('karyawans')->insert($data);
                if ($simpan) {
                    if ($request->hasFile('foto')) {
                        $folderPath = "public/uploads/karyawan/";
                        $request->file('foto')->storeAs($folderPath, $foto);
                        
                    }
                    return Redirect::back()->with(['success' => 'Data Berhsil Disimpan']);
                    }
                } catch (\Exception $e){
                    // dd($e);
                    if ($e->getCode() == 23000) {
                        $message = "Data dengan Nik " . $nik . " Karena Data Sudah Ada ";
                    }
                    return Redirect::back()->with(['warning' => 'Data Gagal Disimpan' . $message]);
                }
            }

    public function editprofile (Request $request) {
        {   
            //$nik = Auth::guard('karyawan')->user()->nik;\
            $nik        = $request->nik;
            $departemen = DB::table('departemen')->get();
            $karyawan   = DB::table('karyawans')->where('nik',$nik)->first();
            //dd($karyawan);
          
            return view('karyawan.editprofile',compact('karyawan','departemen'));
        }
    }

    // public function updateprofile ($nik, Request $request) {
    //     $nik = $request->nik;
    //     $nama_lengkap = $request->nama_lengkap;
    //     $jabatan      = $request->jabatan;
    //     $no_hp        = $request->no_hp;
    //     $kode_dept    = $request->kode_dept;
    //     $password     = Hash::make('12345');
    //     //$karyawan     = DB::table('karyawans')->where('nik',$nik)->first();
    //     $old_foto     = $request->foto;
    //     if ($request->hasFile('foto')) {
    //         $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
    //     }else {
    //         //$foto = $karyawan->foto;
    //         $foto = $old_foto;
    //     }
        
    //     try {
    //         $data = [
    //             'nama_lengkap' => $nama_lengkap,
    //             'jabatan'      => $jabatan,
    //             'no_hp'        => $no_hp,
    //             'kode_dept'    => $kode_dept,
    //             'foto'         => $foto,
    //             'password'     => $password
    //         ];
    //         $update = DB::table('karyawans')->where('nik',$nik)->update($data);
    //         if ($update) {
    //             if ($request->hasFile('foto')) {
    //                 $folderPath    = "public/uploads/karyawan/";
    //                 $folderPathOld = "public/uploads/karyawan/" . $old_foto;
    //                 Storage::delete($folderPathOld);
    //                 $request->file('foto')->storeAs($folderPath, $foto);
                    
    //             }
    //             return redirect('/karyawan')->with(['success'=>'Data Berhasil DiUpdate']);
    //             //return Redirect::back()->with(['success' => 'Data Berhsil Diupdate']);
    //             }
    //         } catch (\Exception $e){
    //             dd($e);
    //             return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
    //         }

    // }
    public function update ($nik, Request $request) {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan      = $request->jabatan;
        $no_hp        = $request->no_hp;
        $kode_dept    = $request->kode_dept;
        $password     = Hash::make('12345');
        $kode_cabang  = $request->kode_cabang;
        //$karyawan     = DB::table('karyawans')->where('nik',$nik)->first();
        $old_foto     = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        }else {
            //$foto = $karyawan->foto;
            $foto = $old_foto;
        }
        
        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan'      => $jabatan,
                'no_hp'        => $no_hp,
                'kode_dept'    => $kode_dept,
                'kode_cabang'  => $kode_cabang,
                'foto'         => $foto,
                'password'     => $password
            ];
            $update = DB::table('karyawans')->where('nik',$nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath    = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                    
                }
                return redirect('/karyawan')->with(['success'=>'Data Berhasil DiUpdate']);
                //return Redirect::back()->with(['success' => 'Data Berhsil Diupdate']);
                }
            } catch (\Exception $e){
                dd($e);
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }

    }


    public function delete ($nik) {
        $delete = DB::table('karyawans')->where('nik', $nik)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di hapus']);
        }
    }


    public function edit (Request $request) {
        {   
            //$nik = Auth::guard('karyawan')->user()->nik;\
            $nik        = $request->nik;
            $departemen = DB::table('departemen')->get();
            $karyawan   = DB::table('karyawans')->where('nik',$nik)->first();
            $cabang     = DB::table('cabang')->orderBy('id')->get();
            //dd($karyawan);
          
            return view('karyawan.edit',compact('karyawan','departemen','cabang'));
        }
    }

}


    