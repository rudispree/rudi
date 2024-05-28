<?php

namespace App\Exports;

use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;




class LaporanKaryawanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($presensi)
    {
        $this->presensi = $presensi;
    }

    public function collection()
    {
        return $this->presensi;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Nik',
            'Tanggal',
            'Jam Masuk',
            'Jam Keluar',
        ];
    }

}
