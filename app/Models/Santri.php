<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable =[
        'nis',
        'nama_santri',
        'alamat',
        'total_paket_diterima',
        'asrama',
    ];

    // public function asrama()
    // {
    //     return $this->belongsTo(Asrama::class);
    // }

    public function asrama2()
    {
        return $this->belongsTo(Asrama::class,'asrama','id');
    }
}
