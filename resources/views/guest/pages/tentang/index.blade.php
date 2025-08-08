@extends('guest.layouts.master')

@section('title', 'Tentang CODEXCITED')

@section('css')
<style>
    .hero-section {
    position: relative;
    width: 100%;
    padding: 4rem 1rem;
    background: url('https://i.pinimg.com/1200x/b6/dc/5e/b6dc5ee29bcf9dd46af864b4896cb7da.jpg') center/cover no-repeat;
    color: white;
    text-align: center;
    overflow: hidden;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.45); /* overlay gelap transparan */
        z-index: 0;
    }

    .hero-section .container {
        position: relative;
        z-index: 1;
        animation: fadeSlideUp 1.2s ease-out forwards;
    }

    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .hero-section h1 {
        font-weight: 700;
        font-size: 2.5rem;
        color: #fff;
    }

    .feature-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        transition: transform 0.15s, box-shadow 0.15s;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: #06BBCC;
    }
</style>
@endsection

@section('content')
<div class="py-5">

    {{-- Hero Section --}}
    <div class="hero-section mb-5">
        <div class="container">
            <h1>Selamat Datang di CODEXCITED</h1>
            <p class="lead mt-3">Platform belajar interaktif untuk meningkatkan skill pemrogramanmu dengan materi berkualitas dan pengalaman belajar yang menyenangkan.</p>
        </div>
    </div>

    <div class="container">
        {{-- Tentang --}}
        <div class="mb-5">
            <h2 class="fw-bold mb-3 text-center">Apa itu CODEXCITED?</h2>
            <p class="text-muted text-center mx-auto" style="max-width: 800px;">
                CODEXCITED adalah platform pembelajaran online yang dirancang khusus untuk membantu pelajar, mahasiswa, maupun profesional dalam menguasai pemrograman dan teknologi. 
                Kami menyediakan materi yang terstruktur, kuis interaktif, dan latihan praktis yang bisa langsung diaplikasikan.
            </p>
        </div>

        {{-- Fitur Keunggulan --}}
        <div class="mb-5">
            <h2 class="fw-bold mb-4 text-center">Keunggulan Kami</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-journal-code"></i>
                        </div>
                        <h5 class="fw-bold">Materi Lengkap & Terstruktur</h5>
                        <p class="text-muted">Materi disusun dari level pemula hingga mahir, lengkap dengan teori dan contoh kode yang mudah dipahami.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <h5 class="fw-bold">Kuis Interaktif</h5>
                        <p class="text-muted">Uji pemahamanmu dengan kuis pilihan ganda yang langsung menampilkan skor dan pembahasan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5 class="fw-bold">Latihan Coding Langsung</h5>
                        <p class="text-muted">Coba tulis dan jalankan kode langsung di browser tanpa perlu install software tambahan.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="text-center mt-5">
            <a href="{{ route('auth.login.index') }}" class="btn btn-primary btn-lg">
                Mulai Belajar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection