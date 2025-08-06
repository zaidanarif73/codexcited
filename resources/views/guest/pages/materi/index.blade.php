@extends('guest.layouts.master')

@section('css')
<style>
    .course-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        transition: transform 0.15s, box-shadow 0.15s;
    }

    .course-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
    }

    .course-image {
        border-radius: 1rem 1rem 0 0;
        object-fit: cover;
        height: 180px;
        width: 100%;
    }

    .category-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: rgba(0, 123, 255, 0.9);
        color: #fff;
        font-size: 0.9rem;
        padding: 0.3em 0.8em;
        border-radius: 999px;
        z-index: 2;
    }

    .card-body {
        flex-grow: 1;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .card-title {
        font-size: 1rem;
    }

    .progress {
        background-color: #e3eafc;
        margin: 0;
    }

    .progress-bar {
        transition: width 0.4s ease;
    }

    @media (max-width: 576px) {
        .course-image {
        height: 120px;
        }

        .card-text {
        font-size: 0.75rem;
        }

        .card-title {
        font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4 px-2 px-md-4">
    <div class="mb-4 text-center">
        <h1 class="fw-bold mb-1">Daftar Materi</h1>
        <p class="text-muted mb-0">Temukan kursus yang sesuai untuk meningkatkan skill-mu!</p>
    </div>

    <div class="row g-4">
        @forelse ($table as $index => $row)
        <div class="col-6 col-lg-3 px-2">
        <a href="{{ route('student.materi.show', ['id' => $row->id, 'slug' => $row->slug]) }}">
            <div class="card course-card position-relative h-100">

                {{-- Kategori --}}
                @if($row->type == 'html')
                <span class="category-badge bg-success">HTML</span>
                @elseif($row->type == 'css')
                <span class="category-badge bg-secondary">CSS</span>
                @elseif($row->type == 'javascript')
                <span class="category-badge bg-warning">JavaScript</span>
                @else
                <span class="category-badge bg-dark">{{ $row->type }}</span>
                @endif
                {{-- Gambar --}}
                <img src="{{ $row->cover ? asset('storage/'.$row->cover) : 'https://i.pinimg.com/736x/79/1b/70/791b70c293bacb9a6fdd4d68eaf3f27c.jpg' }}"
                    alt="{{ $row->title }}" class="course-image">

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                    <h5 class="card-title fw-bold">{{ $row->title }}</h5>
                    <p class="card-text text-muted mb-3">{{ Str::limit($row->description, 200) }}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="badge bg-primary">
                        @if($row->difficulty == 1) Pemula
                        @elseif($row->difficulty == 2) Sedang
                        @elseif($row->difficulty == 3) Lanjutan
                        @else Tidak Diketahui
                        @endif
                    </span>
                    <span class="text-primary fw-semibold">
                        <i class="bi bi-clock me-1"></i>10 Jam
                    </span>
                    </div>
                </div>

            </div>
        </a>
        </div>
        @empty
        <div class="col-12">
        <div class="alert alert-info text-center" role="alert">
            Tidak ada materi yang tersedia saat ini.
        </div>
        </div>
        @endforelse
    </div>
</div>
@endsection