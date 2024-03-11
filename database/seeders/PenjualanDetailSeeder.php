<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $k=26;
        for ($i = 1; $k <= 30; $i++) {
            for($j = 1; $j <=3; $j++){
                DB::table('t_penjualan_detail')->insert([
                    'detail_id' => $k,
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 10),
                    'jumlah' => $jum = rand(1, 4),
                    'harga' => ($jum * rand(1, 3) * 1000)
                ]);
                $k++;
            }
        }
    }
}
