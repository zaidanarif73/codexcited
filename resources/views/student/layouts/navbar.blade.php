<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0" style="padding-top: 0.25rem; padding-bottom: 0.25rem;">
    <div class="container px-4">
        <a href="" class="navbar-brand d-flex align-items-center">
            <h2 class="m-0 text-primary" style="font-size:1.5rem;">
                <i class="fa fa-book me-2"></i>CODEXCITED
            </h2>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapseStudent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapseStudent">
            <div class="navbar-nav ms-auto align-items-center">
                <a href="{{ route('student.dashboard.index') }}" class="nav-item nav-link @if(request()->routeIs('student.dashboard.index')) active @endif">Dashboard</a>
                <a href="{{ route('student.materi.index') }}" class="nav-item nav-link @if(request()->routeIs('student.materi.index')) active @endif"">Materi</a>
                <a href="{{ route('student.leaderboard.index') }}" class="nav-item nav-link @if(request()->routeIs('student.leaderboard.index')) active @endif"">Leaderboard</a>
                {{-- <a href="{{ route('student.discussion.index') }}" class="nav-item nav-link">Forum Diskusi</a> --}}
                <a href="{{ route('auth.logout') }}" class="nav-item nav-link">Logout</a>
                <button id="darkModeToggle" 
                    class="btn btn-light rounded-circle shadow-sm mx-2 p-0" 
                    style="width:36px; height:36px; display:flex; align-items:center; justify-content:center;">
                    <span id="darkModeIcon" style="font-size:1.2rem; transition: transform 0.3s;">🌙</span>
                </button>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->