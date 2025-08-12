@extends('teacher.layouts.master')
@section("title","Aktivitas Siswa ~ CODEXCITED teacher")
@section("title_breadcumb","Aktivitas Siswa") 
@section("breadcumb","Aktivitas Siswa") 

@section('css')
<style>
    .activity-card {
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        padding: 1.5rem;
    }
    .activity-icon img {
        border-radius: 50%;
        width: 42px;
        height: 42px;
        object-fit: cover;
    }
    .table thead th {
        background: #f8f9fc;
        font-weight: 600;
    }
    .table tbody tr:hover {
        background-color: #f5f7fa;
        transition: background 0.2s ease;
    }
    .badge-platform {
        background-color: #e0e7ff;
        color: #3730a3;
    }
    .badge-browser {
        background-color: #dcfce7;
        color: #166534;
    }
    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid white;
    }
    .pulse {
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
<div class="container-fluid">
    <div class="activity-card">
        <h5 class="mb-4"><i class="fas fa-history me-2 text-primary"></i> Log Aktivitas Siswa</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Aktivitas</th>
                        <th>Platform</th>
                        <th>Browser</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $i => $activity)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-2" style="width: 32px; height: 32px;">
                                        <img src="{{ !empty($activity->user_avatar) 
                                                    ? asset('storage/'.$activity->user_avatar) 
                                                    : 'https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg' }}"
                                            alt="Avatar" 
                                            class="rounded-circle" 
                                            style="width: 32px; height: 32px; object-fit: cover;">
                                        <span class="status-indicator {{ $activity->user->isOnline() ? 'bg-success pulse' : 'bg-secondary' }}"></span>
                                    </div>
                                    <div>
                                        <strong>{{ $activity->user->name }}</strong><br>
                                        <small class="text-muted">{{ $activity->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{!! $activity->description !!}</td>
                            <td><span class="badge badge-platform">{{ $activity->device }}</span></td>
                            <td><span class="badge badge-browser">{{ $activity->browser }}</span></td>
                            <td>
                                <small class="text-muted">
                                    {{ $activity->created_at->diffForHumans() }}
                                </small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada aktivitas siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $activities->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection