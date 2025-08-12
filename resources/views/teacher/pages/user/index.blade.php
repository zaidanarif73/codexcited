@extends('teacher.layouts.master')
@section("title","Daftar Siswa ~ CODEXCITED teacher")
@section("title_breadcumb","Users")
@section("breadcumb","Users")

@section('css')
<style>
    .user-card {
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        padding: 1.5rem;
    }
    .table thead th {
        background: #f8f9fc;
        font-weight: 600;
    }
    .table tbody tr:hover {
        background-color: #f5f7fa;
        transition: 0.2s ease;
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
<div class="container-fluid">
    <div class="user-card">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="fas fa-users text-primary me-2"></i> Daftar Siswa</h5>
            <form method="GET" action="">
                <select name="sort" class="form-select form-select-sm shadow-sm border-primary" 
                        style="width: 160px;" onchange="this.form.submit()">
                    <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="name_asc" {{ $sort == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ $sort == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td>
                                <div class="position-relative d-inline-block">
                                    <img src="{{ $student->avatar ? asset('storage/'.$student->avatar) : 'https://i.pinimg.com/736x/15/04/61/150461327bd8b04d7e55d64665196d64.jpg' }}"
                                        alt="Avatar"
                                        class="rounded-circle"
                                        style="width: 42px; height: 42px; object-fit: cover;">
                                    
                                    <span class="status-indicator {{ $student->isOnline() ? 'bg-success pulse' : 'bg-secondary' }}"></span>
                                </div>
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->created_at->format('d M Y H:i:s') }}</td>
                            <td>
                                @if($student->isOnline())
                                    <span class="badge bg-success">Online</span>
                                @else
                                    <span class="badge bg-secondary">Offline</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection