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
        $title = 'Pengantar Pemrograman';
        Materi::create([
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'description' => 'Materi ini memberikan pengantar dasar-dasar pemrograman, termasuk konsep variabel, tipe data, dan struktur kontrol.',
            'type' => 'html',
            'difficulty' => 1, // 1 = Mudah, 2 = Sedang, 3 = Sulit
        ]);
    }
}
