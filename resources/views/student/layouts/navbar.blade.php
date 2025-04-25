    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>CODEXCITED</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapseStudent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapseStudent">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('student.dashboard.index') }}" class="nav-item nav-link active">Dashboard</a>
                <a href="{{ route('student.materi.index') }}" class="nav-item nav-link">Materi</a>
                <a href="{{ route('student.leaderboard.index') }}" class="nav-item nav-link">Leaderboard</a>
                <a href="{{ route('student.discussion.index') }}" class="nav-item nav-link">Forum Diskusi</a>
                <a href="{{ route('auth.logout') }}" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->