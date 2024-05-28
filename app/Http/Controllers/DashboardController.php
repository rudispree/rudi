<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $hariini  = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik     = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        $historibulanini = DB::table('presensi')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
        ->limit(4) 
        ->orderBy('tgl_presensi', 'DESC') // Menambahkan kondisi ASC di sini
        ->get();
        //dd($historibulanini);

        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > jam_masuk ,1,0)) as jmlterlambat')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
        ->first();
        //dd($rekappresensi);

        $leaderboard = DB::table('presensi')
        ->join('karyawans', 'presensi.nik', '=', 'karyawans.nik')
        ->where('tgl_presensi',$hariini)
        ->orderBy('jam_in')
        ->get();
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
        // dd($namabulan[$bulanini]);

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin_dari)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_izin_dari)="' . $tahunini . '"')
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboard',compact('presensihariini','historibulanini','namabulan','bulanini','tahunini','rekappresensi','leaderboard','rekapizin'));
    } 

    public function dashboardadmin() 
    {
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
        ->where('tgl_presensi', $hariini)
        ->first();


        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin_dari', $hariini)
        ->first();


        return view('dashboard.dashboardadminhrd', compact('rekappresensi','rekapizin'));
    }

    public function dashboardadminhrd() 
    {
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
        ->where('tgl_presensi', $hariini)
        ->first();


        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin_dari', $hariini)
        ->first();


        return view('dashboard.dashboardadminhrd', compact('rekappresensi','rekapizin'));
    }
}
