<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPaket extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable =[
        'nama_kategori',
    ];

    // public function nama_kelas()
    // {
    //     return $this->belongsTo(Kelas::class,'id_kelas','id');
    // }
}
