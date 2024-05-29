<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class cabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cabang::Create( [
            'cabang' => 'Cabang Pusat',
         ]);

        Cabang::Create( [
             'cabang' => 'Cabang Daerah',
         ]);
    }
}
