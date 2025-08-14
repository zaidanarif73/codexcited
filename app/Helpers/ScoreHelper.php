<?php

use App\Models\ScoreLog;

if (!function_exists('logScore')) {
    /**
     * Simpan log skor user.
     *
     * @param int $userId       ID user
     * @param string $source    Sumber skor (misal: quiz, editor, dll)
     * @param int|float $score  Nilai skor yang didapat
     * @param int|float $total  Total skor setelah update
     */
    function logScore(int $userId, string $source, $score, $total)
    {
        ScoreLog::create([
            'user_id'     => $userId,
            'source'      => $source,
            'score'       => $score,
            'total_score' => $total,
        ]);
    }
}