<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'CCRN',
                'barang_nama' => 'Coco Corn',
                'harga_beli' => 35000,
                'harga_jual' => 45000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'PCRN',
                'barang_nama' => 'Pop Corn',
                'harga_beli' => 30000,
                'harga_jual' => 40000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'MLKT',
                'barang_nama' => 'Milk Tea',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'KFKA',
                'barang_nama' => 'Kopi Kapal Apung',
                'harga_beli' => 20000,
                'harga_jual' => 30000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'LPSW',
                'barang_nama' => 'Lipstick Windah',
                'harga_beli' => 50000,
                'harga_jual' => 70000,
            ],            
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'MSKP',
                'barang_nama' => 'Mask Pounds',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'SPFA',
                'barang_nama' => 'Sepatu Football Adinda',
                'harga_beli' => 100000,
                'harga_jual' => 150000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'BBSK',
                'barang_nama' => 'Bola Basketball',
                'harga_beli' => 120000,
                'harga_jual' => 180000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'SDLS',
                'barang_nama' => 'Sendal Swelow',
                'harga_beli' => 40000,
                'harga_jual' => 60000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'NSAJ',
                'barang_nama' => 'NIKI Air Jorhan',
                'harga_beli' => 80000,
                'harga_jual' => 120000,
            ]                       
        ];
        DB::table('m_barang')->insert($data);
    }
}
