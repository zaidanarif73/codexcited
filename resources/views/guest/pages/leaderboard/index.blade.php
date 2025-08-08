@extends('guest.layouts.master')

@section('title', 'Leaderboard - CODEXCITED Guest')


@section('css')
<style>
    body {
        background: linear-gradient(to bottom right, #f8f9ff, #eef2ff);
        min-height: 100vh;
    }

    .leaderboard-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .leaderboard-title {
        font-size: 2rem;
        font-weight: 700;
        color: #181d38;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .table thead {
        background-color: #06BBCC;
        color: #fff;
    }

    .table tbody tr:hover {
        background-color: #f3f4ff;
        transition: background 0.2s;
    }

    .rank-badge {
        font-weight: bold;
        padding: 5px 12px;
        border-radius: 50px;
    }

    .rank-1 {
        background-color: gold;
        color: #000;
    }

    .rank-2 {
        background-color: silver;
        color: #000;
    }

    .rank-3 {
        background-color: #cd7f32;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="leaderboard-container">
    <h1 class="leaderboard-title">🏆 Leaderboard CODEXCITED</h1>
    <p class="text-center mb-4 text-muted">
        Lihat siapa yang berada di puncak peringkat berdasarkan skor tertinggi!
    </p>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($scores as $index => $score)
                    <tr>
                        <td>
                            <span class="rank-badge rank-{{ $index+1 <= 3 ? $index+1 : '' }}">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td>{{ $score->user->name }}</td>
                        <td>{{ $score->score }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted">Belum ada data skor</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection