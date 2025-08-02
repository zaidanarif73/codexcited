<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kuis;

class KuisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kuisData = [
            [
                'materi_id' => 1,
                'question' => "Siapa penemu bola lampu?",
                'options' => ["Einstein", "Newton", "Edison", "Tesla"],
                'correct' => 2,
                'explanation' => "Thomas Edison dikenal sebagai penemu bola lampu yang bisa bertahan lama, walau banyak ilmuwan lain juga berkontribusi.",
            ],
            [
                'materi_id' => 1,
                'question' => "Apa hasil dari 2 + 2?",
                'options' => ["2", "3", "4", "5"],
                'correct' => 2,
                'explanation' => "2 + 2 = 4 adalah dasar dari operasi penjumlahan dalam matematika dasar.",
            ],
            [
                'materi_id' => 2,
                'question' => "HAHAHAHAHHA",
                'options' => ["2", "3", "4", "5"],
                'correct' => 2,
                'explanation' => "HAHAHAHAHHHAA",
            ],
        ];

        foreach ($kuisData as $kuis) {
            Kuis::create($kuis);
        }
    }
}
