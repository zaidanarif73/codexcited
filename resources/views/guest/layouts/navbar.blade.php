<!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>CODEXCITED</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">Tentang</a>
                <a href="courses.html" class="nav-item nav-link">Materi</a>
                <a href="contact.html" class="nav-item nav-link">Leaderboard</a>
            </div>
            <a href="{{ route('auth.login.index') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Belajar Sekarang<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
<!-- Navbar End -->