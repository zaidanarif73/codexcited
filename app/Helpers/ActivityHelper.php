<?php

use App\Models\StudentActivity;
use Jenssegers\Agent\Agent;

if (!function_exists('logActivity')) {
    /**
     * Simpan log aktivitas siswa.
     *
     * @param string $type         Jenis aktivitas (misal: open_quiz, submit_quiz, open_materi)
     * @param int|null $relatedId  ID yang terkait (misal ID materi/kuis)
     * @param string|null $desc    Deskripsi aktivitas
     */
    function logActivity(string $type, ?int $relatedId = null, ?string $desc = null)
    {
        if (!auth()->check()) {
            return; // Kalau belum login, skip
        }

        $agent = new Agent();

        StudentActivity::create([
            'user_id'       => auth()->id(),
            'activity_type' => $type,
            'related_id'    => $relatedId,
            'description'   => $desc,
            'device'       => $agent->platform() ?: 'Unknown Device',
            'browser'      => $agent->browser() ?: 'Unknown Browser',
        ]);
    }
}