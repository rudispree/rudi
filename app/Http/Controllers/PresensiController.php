<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\LaporanKaryawanExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\ToModel;
use Excel;

class PresensiController extends Controller
{
    public function gethari()
    {
        $hari = date("D");

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;
            
            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;
            
            default:
                $hari_ini = "Tidak Di Ketahui";
                break;      
        }
        return $hari_ini;
    }
    public function create(){
        $hariini = date("Y-m-d");
        $namahari= $this->gethari();
        $nik     = Auth::guard('karyawan')->user()->nik;
        $cek     = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $lok_kantor = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        // dd($lokasi_kantor);
        $jamkerja = DB::table('konfigurasi_jamkerja')
        ->join('jam_kerja', 'konfigurasi_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik',$nik)->where('hari',$namahari)->first();
        return view('presensi.create',compact('cek','lok_kantor','jamkerja'));
    }

    public function store(Request $request)
    {
       
        $nik = Auth::guard('karyawan')->user()->nik;
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        // $latitudekantor =  -6.23264725192319;          
        // $longitudekantor = 106.64089753979944;
        $lok_kantor = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        $lok            = explode(",", $lok_kantor->lokasi_kantor);
        $latitudekantor =  $lok[0];          
        $longitudekantor = $lok[1];
        $lokasi= $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor,$longitudekantor,$latitudeuser,$longitudeuser);
        $radius = round($jarak["meters"]);
        // dd($radius);

        $namahari= $this->gethari();
        $jamkerja = DB::table('konfigurasi_jamkerja')
        ->join('jam_kerja', 'konfigurasi_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik',$nik)->where('hari',$namahari)->first();

        // cek data jam kerja karyawan
     

        $cek     = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        if($cek > 0) {
            $ket = "out";
        }else {
            $ket = "in";
        }
        $image=  $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-" . $tgl_presensi . "_" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]); 
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        $data = [
            'nik'          => $nik,
            'tgl_presensi' => $tgl_presensi,
            'jam_in'       => $jam,
            'foto_in'      => $fileName,
            'lokasi_in'    => $lokasi
        ];
       
        if ($radius > $lok_kantor->radius) {
            echo "Error| Maaf anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari kantor|radius";

        }else {
        
        if($cek > 0) {
            if($jam < $jamkerja->jam_pulang) {
                echo "error|Maaf Belum Waktunya Pulang |out";
            }else {
                $data_pulang = [
                    'jam_out'       => $jam,
                    'foto_out'      => $fileName,
                    'lokasi_out'     => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    //echo 0;
                    echo "success|Terimakasih, Hati Hati dijalan|out";
                    Storage::put($file, $image_base64);
                }else {
                    //echo 1;
                    echo "error|Maaf Gagal Absen, Hubungi Admin";
                }
            }
           
        }else {
            if ($jam < $jamkerja->awal_jam_masuk) {
                echo "Error|Maaf Belum Waktunya Melakukan Presensi|IN";
            } else if ($jam > $jamkerja->akhir_jam_masuk) {
                echo "Error|Maaf Waktu Untuk Presensi Sudah Habis|IN";
            } else {
                $data = [
                    'nik'          => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in'       => $jam,
                    'foto_in'      => $fileName,
                    'lokasi_in'    => $lokasi,
                    'kode_jam_kerja' => $jamkerja->kode_jam_kerja
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                }else {
                    echo "error|Maaf Gagal Absen, Hubungi Admin";
                }
            }
            
        }
    }
        // echo "0";
    }

    // fungsi untuk Menghitung Jarak Kantor
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile() 
    {   
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawans')->where('nik',$nik)->first();
        // dd($karyawan);
        return view('presensi.editprofile',compact('karyawan'));
    }


    public function updateprofile (Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan= DB::table('karyawans')->where('nik',$nik)->first();
        if($request->hasFile('foto')){
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        if(empty($request->password)) {
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'no_hp'         => $no_hp,
                'foto'          => $foto
            ];
        } else {
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'foto'          => $foto
            ];
        }

        $update = DB::table('karyawans')->where('nik', $nik)->update($data);
        if ($update) {
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath,$foto);
            }
             return redirect()->back()->with(['success' => 'Data BerhasilDi Update']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal di Update']);
        }
       
    }
    

    public function histori(){
       
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
        return view('presensi.histori',compact('namabulan'));
    }

    public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        //echo $bulan . "dan" . $tahun;
        $nik  = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
        ->get();

        // dd($histori);
        return view('presensi.gethistori', compact('histori'));
    }

    public function izin(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')
        ->leftJoin('master_cuti','pengajuan_izin.kode_cuti_karyawan','=','master_cuti.kode_cuti')
        ->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
    }
    
    public function buatizin(){
        
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request){
        //return view('presensi.buatizin');
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin   = $request->tgl_izin;
        $status     = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik'        => $nik,
            'tgl_izin'   => $tgl_izin,
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


    public function monitoring(){
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*', 'nama_lengkap','karyawans.kode_dept', 'nama_dept','jam_masuk','nama_jam_kerja','jam_masuk','jam_pulang')
        ->leftjoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->join('karyawans','presensi.nik', '=', 'karyawans.nik')
        ->join('departemen', 'karyawans.kode_dept', '=', 'departemen.kode_dept')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function laporan() 
    {
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
        $karyawan  = DB::table('karyawans')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namabulan','karyawan'));
    } 

    public function cetaklaporan(Request $request)
    {
        $nik     = $request->nik;
        $bulan   = $request->bulan;
        $tahun   = $request->tahun;
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
        $karyawan = DB::table('karyawans')->where('nik', $nik)
        ->join('departemen','karyawans.kode_dept', '=', 'departemen.kode_dept')
        ->first();

        $presensi = DB::table('presensi')
        ->leftjoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->orderBy('tgl_presensi')
        ->get();
        return view('presensi.cetaklaporan', compact('bulan','tahun', 'namabulan', 'karyawan', 'presensi'));
    }

    public function rekap()
    {
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
       
        return view('presensi.rekap', compact('namabulan',));
    }

    public function cetakrekap(Request $request) 
    {
        $bulan   = $request->bulan;
        $tahun   = $request->tahun;
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desemeber"];
        $rekap   = DB::table('presensi')
        ->selectRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang,
            MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"_", IFNULL(jam_out,"00:00:00")),"")) as tgl_31')
        ->join('karyawans','presensi.nik','=','karyawans.nik')
        ->leftjoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupByRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang')
        ->get();

        if (isset($_POST['exportexcel'])) {
            $time = date("d-M-Y H:i:s");

            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi Karyawan $time.xls");
        }
        // dd($rekap);
        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namabulan', 'rekap'));
    }


    public function izinsakit(Request $request)
    {
       
       
        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin_dari','pengajuan_izin.nik', 'nama_lengkap', 'jabatan', 'status', 'status_approved','keterangan');
        $query->join('karyawans','pengajuan_izin.nik', '=', 'karyawans.nik');

       
       
        if(!empty($request->dari) && !empty($request->sampai)) {
            $request->whereDateBetween('tgl_izin_dari', [$request->dari, $request->sampai]);
        }
        $query->orderBy('tgl_izin_dari', 'desc');
        
        $izinsakit = $query->get();
        $izinsakit = $query->paginate(5);
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function caritanggal(Request $request)
    {
       
       $fromDate = $request->input('dari');
       $toDate = $request->input('sampai');
       $nama = $request->input('nama_lengkap');
       $status = $request->input('status_approved');
       $nik = $request->input('nik');

       $query = DB::table('pengajuan_izin')->select('id','tgl_izin','pengajuan_izin.nik', 'nama_lengkap', 'jabatan', 'status', 'status_approved','keterangan')
       ->where('tgl_izin', '>=', $fromDate)
       ->where('tgl_izin', '<=', $toDate)
       ->where('nama_lengkap', 'LIKE', '%'.$nama.'%')
       ->where('status_approved', 'LIKE', '%'.$status.'%')
    //    ->orWhere('status_approved', 'LIKE', '%'.$status.'%')
       ->where('pengajuan_izin.nik', 'LIKE', '%'.$nik.'%')
       ->join('karyawans','pengajuan_izin.nik', '=', 'karyawans.nik')
       ->get();
        
    //    dd($query);
       
        // $izinsakit = DB::table('pengajuan_izin')
        // ->select('id','tgl_izin','pengajuan_izin.nik', 'nama_lengkap', 'jabatan', 'status', 'status_approved','keterangan')
        // ->join('karyawans','pengajuan_izin.nik', '=', 'karyawans.nik')
        // ->get();
        
        return view('presensi.caridataizinsakit', compact('query'));
    }

    public function approveizinsakit (Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update   = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }

    }

    public function batalkanizinsakit ($id) {
        $update   = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }


    public function cekpengajuanizin (Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nik      = Auth::guard('karyawans')->user()->nik;
        $cek      = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        
        return $cek;
    }

    public function cetaklaporankehadiran(Request $request)
  
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nama  = $request->nama_lengkap;
        $nik   = $request->nama_nik;
    
        // Query dengan join tabel
        $presensi = DB::table('presensi')
            ->join('karyawans', 'presensi.nik', '=', 'karyawans.nik')
            ->select('karyawans.nama_lengkap','karyawans.nik', 'presensi.tgl_presensi', 'presensi.jam_in', 'presensi.jam_out')
            // ->where('karyawans.nama_lengkap', 'LIKE', '%' . $nama . '%')
            ->where('karyawans.nik', 'LIKE', '%' . $nama . '%')
            ->whereMonth('presensi.tgl_presensi', $bulan)
            ->whereYear('presensi.tgl_presensi', $tahun)
            // ->groupByRaw('presensi.nik')
            ->get();

       
       

        // Memanggil class export dan mengirim data presensi
        return Excel::download(new LaporanKaryawanExport($presensi), 'presensi.xlsx');

     
        // dd($rekap);
      
    }

    public function showact($kode_izin){
        $dataizin = DB::table('pengajuan_izin')->where('id', $kode_izin)->first();
        // dd($dataizin);
        return view('presensi.showact', compact('dataizin'));
    }
}

