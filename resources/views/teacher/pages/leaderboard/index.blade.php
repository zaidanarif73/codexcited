@extends('teacher.layouts.master')
@section("title","Leaderboard Siswa ~ CODEXCITED teacher")
@section("title_breadcumb","Leaderboard")
@section("breadcumb","Leaderboard")

@section('css')
<style>
    .leaderboard-card {
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        padding: 1.5rem;
    }
    .rank-badge {
        font-size: 1rem;
        font-weight: bold;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
    }
    .rank-1 { background-color: gold; color: #fff; }
    .rank-2 { background-color: silver; color: #fff; }
    .rank-3 { background-color: #cd7f32; color: #fff; }
    .table tbody tr:hover {
        background-color: #f5f7fa;
        transition: 0.2s;
    }
    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        border: 2px solid white; /* biar ada outline di sekitar bulatan */
    }
    .bg-success {
    background-color: #28a745 !important;
    }

    .bg-success.pulse {
        animation: pulse-animation 1.5s infinite;
    }

    @keyframes pulse-animation {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { box-shadow: 0 0 0 6px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
</style>
@endsection

@section("content")
<div class="">
    <div class="leaderboard-card">
        <h5 class="mb-4"><i class="fas fa-trophy text-warning me-2"></i> Leaderboard Siswa</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Siswa</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leaderboard as $index => $item)
                        <tr>
                            <td>
                                @php $rank = $leaderboard->firstItem() + $index; @endphp
                                <span class="rank-badge rank-{{ $rank <= 3 ? $rank : '' }}">
                                    {{ $rank }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="position-relative d-inline-block mx-3">
                                        <img src="{{ $item->user_avatar ? asset('storage/'.$item->user_avatar) : 'https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg' }}" 
                                            alt="Avatar" 
                                            class="rounded-circle" 
                                            style="width: 48px; height: 48px; object-fit: cover; flex-shrink: 0;">
                                        <span class="status-indicator {{ $item->user->isOnline() ? 'bg-success pulse' : 'bg-secondary' }}"></span>
                                    </div>
                                    <div>
                                        <strong>{{ $item->user->name }}</strong><br>
                                        <small class="text-muted">{{ $item->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><strong>{{ $item->score }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data skor</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $leaderboard->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection