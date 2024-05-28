<?php

namespace App\Exports;

use App\Models\Karyawan; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class KaryawanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Karyawan::select('nik','nama_lengkap','jabatan','no_hp','foto','password','kode_dept')->get();
      
    }
    

    public function headings(): array {
        return ["NIK","NAMA","JABATAN","NO HP","Foto","password","kode_dept"];
    }

}
