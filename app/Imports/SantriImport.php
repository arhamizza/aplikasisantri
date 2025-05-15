<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;

class SantriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Santri([
            'nis' => $row[1],
            'nama_santri' => $row[2], 
            'alamat' => $row[3], 
            'total_paket_diterima' => $row[4], 
            'asrama' => $row[5], 
        ]);
    }
}
