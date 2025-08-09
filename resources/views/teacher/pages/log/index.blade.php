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
    .activity-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f9;
        font-size: 18px;
        color: #4e73df;
    }
    .table thead th {
        background: #f8f9fc;
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
                                    <div class="activity-icon me-2">
                                        @if(!empty($activity->user_avatar))
                                            <img src="{{asset('storage/'.$activity->user_avatar)}}" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">               
                                        @else
                                            <img src="https://i.pravatar.cc/48?img=1" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $activity->user->name }}</strong><br>
                                        <small class="text-muted">{{ $activity->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{!! $activity->description !!}</td>
                            <td><span class="badge bg-light text-muted">{{ $activity->device }}</span></td>
                            <td><span class="badge bg-light text-success">{{ $activity->browser }}</span></td>
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