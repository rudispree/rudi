<?php

namespace App\Imports;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Karyawan([
            'nik'          => $row['nik'],
            'nama_lengkap' => $row['nama_lengkap'],
            'jabatan'      => $row['jabatan'],
            'no_hp'        => $row['no_hp'],
            'kode_dept'    => $row['kode_dept'],
            'foto'         => $row['foto'],
            'password'     => Hash::make($row['password'])
        ]);
    }
}
 