<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>CODEXCITED</h2>
    </a>
    <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('guest.') }}" class="nav-item nav-link @if(request()->routeIs('guest.')) active @endif">Beranda</a>
            <a href="{{ route('guest.tentang.index') }}" class="nav-item nav-link @if(request()->routeIs('guest.tentang.index')) active @endif">Tentang</a>
            <a href="{{ route('guest.materi.index') }}" class="nav-item nav-link @if(request()->routeIs('guest.materi.index')) active @endif">Materi</a>
            <a href="{{ route('guest.leaderboard.index') }}" class="nav-item nav-link @if(request()->routeIs('guest.leaderboard.index')) active @endif">Leaderboard</a>
            <a href="https://drive.google.com/file/d/1ZslHwfcfn7u-dSEpRPMg_-fblSBcQmz7/view?usp=sharing" target="_blank" class="nav-item nav-link"> Panduan </a>                
            <!-- Tombol mobile, tampil hanya di bawah lg -->
            <a href="{{ route('auth.login.index') }}" class="btn btn-primary btn-sm d-lg-none  mt-3" style="border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                Masuk Sekarang <i class="fa fa-arrow-right mx-3"></i>
            </a>
        </div>

        <!-- Tombol desktop -->
        <a href="{{ route('auth.login.index') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
            Masuk Sekarang <i class="fa fa-arrow-right ms-3"></i>
        </a>
    </div>
</nav>
<!-- Navbar End -->