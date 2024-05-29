<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Level::Create( [
           'level' => 'Admin Super',
        ]);

       Level::Create( [
            'level' => 'Kacab',
        ]);

       Level::Create( [
            'level' => 'Sales'
        ]);

       Level::Create( [
        'level' => 'Administrator Head',
        ]);

       Level::Create( [
        'level' => 'Kepala Bengkel',
        ]);
    }
}
