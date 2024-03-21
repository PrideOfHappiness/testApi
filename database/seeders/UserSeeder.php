<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'Admin123',
                'nama' => 'Administrator',
                'alamat' => 'Jl. SOS nomor 255 Kelurahan Tes Kecamatan Tes Kota Tes',
                'no_telp' => '12345678901234',
                'status' => 'Active',
                'user_access' => 'Admin',
                'email' => 'admin@apiUsers.com',
                'password' => bcrypt('admin1234567'),
            ],
            [
                'username' => 'User123',
                'nama' => 'User',
                'alamat' => 'Jl. Laboratorium nomor 125 Kelurahan Tes Kecamatan Tes Kota Tes',
                'no_telp' => '14785236901234',
                'status' => 'Active',
                'user_access' => 'User',
                'email' => 'user@apiUsers.com',
                'password' => bcrypt('user1234567'),
            ],
            [
                'username' => 'Verifikator123',
                'nama' => 'Verifikator',
                'alamat' => 'Jl. Desinfektan nomor 25 Kelurahan Tes Kecamatan Tes Kota Tes',
                'no_telp' => '159874563012',
                'status' => 'Active',
                'user_access' => 'Verifikator',
                'email' => 'verifikator@apiUsers.com',
                'password' => bcrypt('verifikator1234567'),
            ],
        ];

        foreach($data as $valueMasukTabelUser){
            User::create($valueMasukTabelUser);
        }
    }
}
