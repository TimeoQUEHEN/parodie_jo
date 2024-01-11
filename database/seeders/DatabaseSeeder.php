<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Athlete;
use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'gralfjord',
            'email' => 'gralfjord@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'isAdmin'=>true,
        ]);

        \App\Models\User::factory(2)->create();
        Athlete::factory(20)->create();

        $this->call(SportSeeder::class);

        for ($i = 1 ; $i < count(Sport::all()) ; $i++) {
            for ($j = 1 ; $j < count(Athlete::all()) ; $j++) {
                if (rand(0,10) > 7) {
                    DB::table("classement")->insert([
                        "sport_id" => $i,
                        "athlete_id" => $j,
                        "rang" => rand(1, 50),
                        "performance" => Str::random(12)
                    ]);
                }
            }
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
