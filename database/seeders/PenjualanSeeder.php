<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('t_penjualan')->insert([
                'penjualan_id' => $i,
                'user_id' => rand(1, 3),
                'pembeli' => $faker->name,
                'penjualan_kode' => Carbon::now()->format('M') . Carbon::now()->year . $faker->regexify('[A-Z]{4}'),
                'penjualan_tanggal' => Carbon::now(),
            ]);
        }
    }
}
