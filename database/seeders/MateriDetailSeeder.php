<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MateriDetail;

class MateriDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MateriDetail::create([
            'materi_id' => 1,
            'title' => 'Pengantar Pemrograman',
            'description' => 'Materi ini memberikan pengantar dasar-dasar pemrograman, termasuk konsep variabel, tipe data, dan struktur kontrol.',
        ]);

        MateriDetail::create([
            'materi_id' => 1,
            'title' => 'Variabel dan Tipe Data',
            'description' => 'Pembahasan tentang variabel, tipe data dasar seperti integer, string, dan boolean.',
        ]);
    }
}
