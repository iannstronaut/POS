<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'kategori_id' => 1,
                'kategori_kode' => 'FOD',
                'kategori_nama' => 'Foods'
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'DRK',
                'kategori_nama' => 'Drinks'
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'BTY',
                'kategori_nama' => 'Beauty'
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'SPR',
                'kategori_nama' => 'Sports'
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'SOE',
                'kategori_nama' => 'Shoes'
            ]
        ];
        DB::table('m_kategori')->insert($data);
    }
}
