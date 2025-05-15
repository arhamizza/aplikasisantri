<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
  
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            "nama_user" => "Saidatul",
            "username" => "admin@admin.com",
            "password" => Hash::make("12345678"),
            "role" => 1
        ]);
        User::create([
            "nama_user" => "Bambang",
            "username" => "user@user.com",
            "password" => Hash::make("12345678"),
            "role" => 2
        ]);

    }
}