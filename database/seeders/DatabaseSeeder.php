<?php
namespace Database\Seeders;

use Database\Factories\datatableFactory;
use Illuminate\Database\Seeder;
use App\Models\datatable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            AsramaTableSeeder::class,
            SantriTableSeeder::class,
            KategoriTableSeeder::class,
            PaketTableSeeder::class
        ]);
        // datatable::Factory()->count(10)->create();
    }
}
