<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SantriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Santri::create([
            "nis" => "1",
            "nama_santri" => "arham",
            "alamat" => "jalan kemuning",
            "total_paket_diterima" => "21",
            "asrama" => "1",
        ]);
        Santri::create([
            "nis" => "2",
            "nama_santri" => "izza",
            "alamat" => "jalan kemuning",
            "total_paket_diterima" => "33",
            "asrama" => "2",
        ]);
        Santri::create([
            "nis" => "3",
            "nama_santri" => "sayny",
            "alamat" => "jalan malang",
            "total_paket_diterima" => "2",
            "asrama" => "3",
        ]);
    }
}
