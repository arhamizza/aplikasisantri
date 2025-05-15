<?php

namespace Database\Seeders;

use App\Models\KategoriPaket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriPaket::create([
            "nama_kategori" => "Makanan Basah",
        ]);
        KategoriPaket::create([
            "nama_kategori" => "Makanan Kering",
        ]);
        KategoriPaket::create([
            "nama_kategori" => "NON makanan",
        ]);
    }
}
