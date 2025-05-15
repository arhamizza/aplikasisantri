<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_asmara',
        'gedung',
    ];

    // public function transaksi()
    // {
    //     return $this->belongsToMany(Transaksi::class,'transaksi_gurus','id_guru','id_transaksi');
    // }
    
}
