<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outlets')->insert([
                [
                'nama'=>'Toko Restu Laundry',
                'alamat'=>'Bagolo',
                'tlp'=>'098765456789'
            ],
            [
                'nama'=>'Toko Restu Laundry',
                'alamat'=>'Pangandaran',
                'tlp'=>'098098765543'
            ],
        ]);

        DB::table('users')->insert([
            [
                'nama'=>'Administrator',
                'username'=>'admin',
                'password'=>bcrypt('1234'),
                'role'=>'admin',
                'outlet_id'=>1,
            ],
            [
                'nama'=>'Kasir',
                'username'=>'kasir',
                'password'=>bcrypt('1234'),
                'role'=>'kasir',
                'outlet_id'=>1,
            ],
            [
                'nama'=>'Pemilik',
                'username'=>'owner',
                'password'=>bcrypt('1234'),
                'role'=>'owner',
                'outlet_id'=>1,
            ]
        ]);

        DB::table('pakets')->insert([
            [
                'nama_paket' => 'Reguler',
                'harga' => 7000,
                'jenis' => 'kiloan',
                'diskon' => 3000,
                'harga_akhir' => 4000,
                'outlet_id' => 1,
            ],
            [
                'nama_paket' => 'Bed Cover',
                'harga' => 5000,
                'jenis' => 'bed_cover',
                'diskon' => 4000,
                'harga_akhir' => 1000,
                'outlet_id' => 1,
            ],
        ]);

        DB::table('members')->insert([
            [
                'nama'=>'Tutu Situtu',
                'jenis_kelamin'=>'L',
                'alamat'=>'Bagolo',
                'tlp'=>'098890876678'
            ],[
                'nama'=>'Restu',
                'jenis_kelamin'=>'L',
                'alamat'=>'Bagolo',
                'tlp'=>'098890435678'
            ],[
                'nama'=>'Anggari',
                'jenis_kelamin'=>'L',
                'alamat'=>'Bagolo',
                'tlp'=>'098890866878'
            ]
        ]);
    }
}
