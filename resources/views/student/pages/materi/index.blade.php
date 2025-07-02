@extends('student.layouts.master')

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
    .instructor-img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 0.5rem;
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
  </style>
@endsection

@section('content')
<div class="container py-4">
    <div class="mb-4 text-center">
      <h1 class="fw-bold mb-1">Daftar Materi</h1>
      <p class="text-muted mb-0">Temukan kursus yang sesuai untuk meningkatkan skill-mu!</p>
    </div>
    <div class="row g-4">
      <!-- Course Card 1 -->
      @forelse ($table as $index => $row)
      <div class="col-md-4">
        <a href="{{ route('student.materi.show', ['id' => $row->id,'materi' => $row->title]) }}">
          <div class="card course-card position-relative h-100">
            <span class="category-badge">Web Development</span>
            @if(!empty($row->cover))
              <img src="{{asset('storage/'.$row->cover)}}" alt="{{ $row->cover }}" class="course-image">
            @else
              <img src="https://i.pinimg.com/736x/79/1b/70/791b70c293bacb9a6fdd4d68eaf3f27c.jpg" alt="{{ $row->cover }}" class="course-image">
            @endif
            <div class="card-body">
              <h5 class="card-title fw-bold">{{ $row->title }}</h5>
              <p class="card-text text-muted mb-2">{{ $row->description }}</p>
              <div class="d-flex align-items-center mb-2">
                <img src="https://i.pravatar.cc/36?img=12" alt="Instructor" class="instructor-img">
                <span class="small text-muted">by <b>Rina Putri</b></span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-success">Beginner</span>
                <span class="text-primary fw-semibold"><i class="bi bi-clock me-1"></i>10 Jam</span>
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
      {{-- <!-- Course Card 1 -->
      {{-- <!-- Course Card 2 -->
      <div class="col-md-4">
        <div class="card course-card position-relative h-100">
          <span class="category-badge bg-danger">CSS</span>
          <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Advanced CSS" class="course-image">
          <div class="card-body">
            <h5 class="card-title fw-bold">Advanced CSS</h5>
            <p class="card-text text-muted mb-2">Tingkatkan kemampuan styling dengan Flexbox, Grid, animasi, dan teknik modern CSS.</p>
            <div class="d-flex align-items-center mb-2">
              <img src="https://i.pravatar.cc/36?img=5" alt="Instructor" class="instructor-img">
              <span class="small text-muted">by <b>Sarah Wijaya</b></span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-danger">Advanced</span>
              <span class="text-primary fw-semibold"><i class="bi bi-clock me-1"></i>15 Jam</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Course Card 3 -->
      <div class="col-md-4">
        <div class="card course-card position-relative h-100">
          <span class="category-badge bg-warning">Programming</span>
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" alt="JavaScript Basics" class="course-image">
          <div class="card-body">
            <h5 class="card-title fw-bold">JavaScript Basics</h5>
            <p class="card-text text-muted mb-2">Pelajari sintaks dasar, variabel, fungsi, dan logika pemrograman JavaScript.</p>
            <div class="d-flex align-items-center mb-2">
              <img src="https://i.pravatar.cc/36?img=8" alt="Instructor" class="instructor-img">
              <span class="small text-muted">by <b>Andi Nugroho</b></span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-info">Intermediate</span>
              <span class="text-primary fw-semibold"><i class="bi bi-clock me-1"></i>12 Jam</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Add more course cards as needed --> --}}
    </div>
  </div>
@endsection

