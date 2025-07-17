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
    .card-img-top {
      max-height: 180px;
      object-fit: cover;
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
      <div class="col-12 col-sm-6 col-md-4">
        <a href="{{ route('student.materi.show', ['id' => $row->id,'slug' => $row->slug]) }}">
          <div class="card course-card position-relative h-100">
            @if($row->type == 'html')
              <span class="category-badge bg-success">HTML</span>
            @elseif($row->type == 'css')
              <span class="category-badge bg-secondary">CSS</span>
            @elseif($row->type == 'javascript')
              <span class="category-badge bg-warning">JavaScript</span>
            @else
              <span class="category-badge bg-dark">{{ $row->type }}</span>
            @endif

            @if(!empty($row->cover))
              <img src="{{asset('storage/'.$row->cover)}}" alt="{{ $row->cover }}" class="course-image">
            @else
              <img src="https://i.pinimg.com/736x/79/1b/70/791b70c293bacb9a6fdd4d68eaf3f27c.jpg" alt="{{ $row->cover }}" class="course-image">
            @endif
            <div class="card-body">
              <h5 class="card-title fw-bold">{{ $row->title }}</h5>
              <p class="card-text text-muted mb-2">{{ Str::limit($row->description, 200) }}</p>
              <div class="d-flex align-items-center mb-2">
                <img src="https://i.pravatar.cc/36?img=12" alt="Instructor" class="instructor-img">
                <span class="small text-muted">by <b>Rina Putri</b></span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                @if($row->difficulty == 1)
                  <span class="badge bg-primary">Pemula</span>
                @elseif($row->difficulty == 2)
                  <span class="badge bg-primary">Sedang</span>
                @elseif($row->difficulty == 3)
                  <span class="badge bg-primary">Lanjutan</span> 
                @else
                  <span class="badge bg-primary">Tidak Diketahui</span>
                @endif                  
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
    </div>
  </div>
@endsection

