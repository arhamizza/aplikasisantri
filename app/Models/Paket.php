<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable =[
        'nama_paket',
        'tanggal_diterima',
        'kategori_paket',
        'penerima_paket',
        'asrama',
        'pengirim_paket',
        'isi_paket_yang_disita',
        'status_paket',
        
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPaket::class,'kategori_paket','id');
    }
    public function asrama()
    {
        return $this->belongsTo(Asrama::class,'asrama','id');
    }

        public function santri()
    {
        return $this->belongsTo(Santri::class,'penerima_paket','nis');
    }

}
