<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the database with initial data.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');


        for ($i = 0; $i < 10; $i++) {
            $userId = Str::uuid();
            DB::table('m_user')->insert([
                'id' => $userId,
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt('test123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $barangId = Str::uuid();
            $nama_barang = "Item $i";
            $kode = sprintf('ITEM%03d', $i);
            $kategoriList = ['kategori 1', 'kategori 2', 'kategori 3'];
            $kategori = $kategoriList[array_rand($kategoriList)];
            DB::table('m_barang')->insert([
                'id' => $barangId,
                'nama_barang' => $nama_barang,
                'kode' => $kode,
                'kategori' => $kategori,
                'lokasi' => $faker->city,
                'deskripsi' => $faker->text,
                'stok' => $faker->numberBetween(0, 100),
                'harga' => $faker->randomFloat(2, 5000, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $barangIds[] = $barangId;
        }

        $userIds = DB::table('m_user')->pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            $mutasiId = Str::uuid();
            DB::table('m_mutasi')->insert([
                'id' => $mutasiId,
                'm_barang_id' => $faker->randomElement($barangIds),
                'm_users_id' => $faker->randomElement($userIds),
                'jenis_mutasi' => $faker->randomElement(['masuk', 'keluar']),
                'jumlah' => $faker->numberBetween(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
