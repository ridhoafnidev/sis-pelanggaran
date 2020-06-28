<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nama_lengkap'=>$row[0],
            'jenis_kelamin'=>$row[1],
            'nis'=>$row[2],
            'tempat_lahir'=>$row[3],
            'tanggal_lahir'=>$row[4],
            'alamat'=>$row[5], 
            'ortu_wali'=>$row[6],
            'rombel'=>$row[7],
            'foto'=>$row[8],
            'jurusan'=>$row[9]
        ]);
    }
}
