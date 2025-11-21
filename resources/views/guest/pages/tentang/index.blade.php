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
        background: rgba(0, 0, 0, 0.45);
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

    .developer-box {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
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
            <p class="text-muted text-center mx-auto" style="max-width: 900px;">
                Platform pembelajaran CODEXCITED dikembangkan oleh <strong>Zaidan Arif</strong>, 
                Mahasiswa Program Studi <strong>Pendidikan Teknik Informatika</strong>, 
                sebagai bagian dari tugas skripsi pengembangan media pembelajaran berbasis website. 
                Platform ini dirancang untuk mendukung kegiatan belajar pemrograman bagi siswa maupun mahasiswa 
                melalui penyajian materi yang terstruktur dan dilengkapi dengan fitur kuis interaktif dan latihan praktik.
            </p>
            <p class="text-muted text-center mx-auto" style="max-width: 900px;">
                Pengembangan platform ini berada di bawah bimbingan <strong>Prof. Dr. H. Hakkun Elmunsyah, S.T., M.T</strong> 
                yang berperan dalam melakukan supervisi, validasi konten, serta memberikan masukan teknis 
                sehingga sistem ini dapat digunakan sebagai media pembelajaran yang efektif dan adaptif terhadap kebutuhan pengguna.
            </p>
        </div>

        {{-- Keunggulan --}}
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

        {{-- Profil Pengembang --}}
        <div class="mt-5">
            <h2 class="fw-bold text-center mb-4">Pengembang Platform</h2>

            <div class="row justify-content-center">

                <!-- Pengembang -->
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="card p-3 border-0 shadow-sm rounded-4">
                        <img src="{{ asset('assets/guest/img/pp.jpg') }}" 
                            class="rounded-circle mx-auto" 
                            width="150" height="150" 
                            style="object-fit: cover;">
                        <h5 class="mt-3 fw-bold">Zaidan Arief</h5>
                        <p class="text-muted mb-1">Frontend & Backend Developer</p>
                        <small class="text-secondary">Mahasiswa Pendidikan Teknik Informatika</small>
                    </div>
                </div>

                <!-- Dosen Pembimbing -->
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="card p-3 border-0 shadow-sm rounded-4">
                        <img src="{{ asset('assets/guest/img/dospem.jpg') }}" 
                            class="rounded-circle mx-auto"
                            width="150" height="150"
                            style="object-fit: cover;">
                        <h5 class="mt-3 fw-bold">Prof. Dr. H. Hakkun Elmunsyah, S.T., M.T</h5>
                        <p class="text-muted mb-1">Dosen Pembimbing</p>
                        <small class="text-secondary">Program Studi Pendidikan Teknik Informatika</small>
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
