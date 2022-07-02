<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        News::factory(10)->create();

        $this->call(PermissionTableSeeder::class);
        $this->call(AdminTableSeeder::class);


    }
}
