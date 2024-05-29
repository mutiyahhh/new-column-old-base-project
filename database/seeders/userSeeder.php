<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create( [
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'nip' => '111111',
            'no_hp' => '087880182823',
            'level_id' => '1',
            'cabang_id' => '1',
            'gender' => 'pria',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Kacab',
            'email' => 'kacab@gmail.com',
            'nip' => '222222',
            'no_hp' => '087880182823',
            'level_id' => '2',
            'cabang_id' => '1',
            'gender' => 'pria',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Sales',
            'email' => 'sales@gmail.com',
            'nip' => '333333',
            'no_hp' => '087880182823',
            'level_id' => '3',
            'cabang_id' => '2',
            'gender' => 'pria',
            'password' => Hash::make(123456789),

        ]);

        User::Create( [
            'name' => 'Administrator',
            'email' => 'administration@gmail.com',
            'nip' => '444444',
            'no_hp' => '087880182823',
            'level_id' => '4',
            'cabang_id' => '1',
            'gender' => 'pria',
            'password' => Hash::make(123456789),
        ]);

        User::Create( [
            'name' => 'Kepala Bengkel',
            'email' => 'kepalabengkel@gmail.com',
            'nip' => '555555',
            'no_hp' => '087880182823',
            'level_id' => '5',
            'cabang_id' => '2',
            'gender' => 'pria',
            'password' => Hash::make(123456789),
        ]);

    }
}
