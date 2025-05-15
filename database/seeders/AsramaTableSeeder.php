<?php

namespace Database\Seeders;

use App\Models\Asrama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsramaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asrama::create([
            "nama_asrama" => "asrama a",
            "gedung" => "gedung kecil",
        ]);
        Asrama::create([
            "nama_asrama" => "asrama b",
            "gedung" => "gedung besar",
        ]);
        Asrama::create([
            "nama_asrama" => "asrama c",
            "gedung" => "gedung menengah",
        ]);
    }
}
