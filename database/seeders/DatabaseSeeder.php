<?php

namespace Database\Seeders;

use App\Models\Topup;
use Carbon\Carbon;
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
         \App\Models\User::factory()->count(500)->create();

        $numberOfData = 600000;
        $seededData = [];
        for ($i = 0; $i < $numberOfData; $i++) {
            $seededData[] = [
                'user_id' => rand(1, 500),
                'amount' => rand(100, 10000),
                'created_at' => Carbon::today()->subDays(rand(1, 3))->hour(rand(0, 23))->minute(rand(0, 59))->second(rand(0, 59)),
                'updated_at' => Carbon::today()->hour(rand(0, 23))->minute(rand(0, 59))->second(rand(0, 59))
            ];
        }
        $chunks = array_chunk($seededData, 5000);
        foreach ($chunks as $chunk) {
            Topup::insert($chunk);
        }
    }
}
