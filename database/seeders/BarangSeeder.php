<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed
        $data = [
            [
                'id' => (string) Str::uuid(),
                'nama_barang' => 'Item 1',
                'kode' => 'ITEM001',
                'kategori' => 'Category A',
                'lokasi' => 'Location X',
                'deskripsi' => 'Description for Item 1',
                'stok' => 100,
                'harga' => 10.00,
            ],
            [
                'id' => (string) Str::uuid(),
                'nama_barang' => 'Item 2',
                'kode' => 'ITEM002',
                'kategori' => 'Category B',
                'lokasi' => 'Location Y',
                'deskripsi' => 'Description for Item 2',
                'stok' => 50,
                'harga' => 20.00,
            ],
            // Add more records as needed
        ];

        // Insert data into the 'barang' table
        DB::table('barang')->insert($data);
    }
}
