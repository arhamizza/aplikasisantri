<?php

namespace Database\Seeders;

use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paket::create([
            'nama_paket' => "paket a",
            'tanggal_diterima' => Carbon::parse('20193-01-01'),
            'kategori_paket'=> "3",
            'penerima_paket'=> "1",
            'asrama'=> "1",
            'pengirim_paket'=> "issa",
            'isi_paket_yang_disita'=> "mobil-mobilan",
            'status_paket'=> "diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket b",
            'tanggal_diterima' => Carbon::parse('2023-06-01'),
            'kategori_paket'=> "3",
            'penerima_paket'=> "2",
            'asrama'=> "1",
            'pengirim_paket'=> "bang",
            'isi_paket_yang_disita'=> "kentang",
            'status_paket'=> "belum_diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket c",
            'tanggal_diterima' => Carbon::parse('2023-01-05'),
            'kategori_paket'=> "1",
            'penerima_paket'=> "3",
            'asrama'=> "1",
            'pengirim_paket'=> "natut",
            'isi_paket_yang_disita'=> "nabati",
            'status_paket'=> "diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket d",
            'tanggal_diterima' => Carbon::parse('2023-01-01'),
            'kategori_paket'=> "3",
            'penerima_paket'=> "3",
            'asrama'=> "1",
            'pengirim_paket'=> "waqe",
            'isi_paket_yang_disita'=> "minum",
            'status_paket'=> "belum_diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket e",
            'tanggal_diterima' => Carbon::parse('2023-12-01'),
            'kategori_paket'=> "1",
            'penerima_paket'=> "2",
            'asrama'=> "1",
            'pengirim_paket'=> "sabyn",
            'isi_paket_yang_disita'=> "keyboard",
            'status_paket'=> "belum_diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket f",
            'tanggal_diterima' => Carbon::parse('2023-11-01'),
            'kategori_paket'=> "2",
            'penerima_paket'=> "2",
            'asrama'=> "1",
            'pengirim_paket'=> "nisa",
            'isi_paket_yang_disita'=> "mouse",
            'status_paket'=> "diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket g",
            'tanggal_diterima' => Carbon::parse('2023-01-01'),
            'kategori_paket'=> "1",
            'penerima_paket'=> "1",
            'asrama'=> "1",
            'pengirim_paket'=> "mam",
            'isi_paket_yang_disita'=> "laptop",
            'status_paket'=> "belum_diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket h",
            'tanggal_diterima' => Carbon::parse('2022-01-01'),
            'kategori_paket'=> "2",
            'penerima_paket'=> "1",
            'asrama'=> "1",
            'pengirim_paket'=> "john",
            'isi_paket_yang_disita'=> "hp",
            'status_paket'=> "diambil",
        ]);
        Paket::create([
            'nama_paket' => "paket i",
            'tanggal_diterima' => Carbon::parse('2021-01-01'),
            'kategori_paket'=> "3",
            'penerima_paket'=> "1",
            'asrama'=> "1",
            'pengirim_paket'=> "robert",
            'isi_paket_yang_disita'=> "motor",
            'status_paket'=> "belum_diambil",
        ]);
    }
}
