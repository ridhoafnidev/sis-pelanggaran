<?php

namespace App\Imports;

use App\Murid;
use Maatwebsite\Excel\Concerns\ToModel;

class MuridImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // dd($row);
        return new Murid([
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
