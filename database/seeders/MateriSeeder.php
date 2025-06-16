<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materi::create([
            'title' => 'Pengantar Pemrograman',
            'description' => 'Materi ini memberikan pengantar dasar-dasar pemrograman, termasuk konsep variabel, tipe data, dan struktur kontrol.',
        ]);
    }
}
