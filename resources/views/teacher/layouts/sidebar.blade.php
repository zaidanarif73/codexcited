<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #23283a;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link d-flex align-items-center justify-content-center">
        <img src="{{URL::to('/')}}/assets/img/favicon.png" alt="CODEXCITED" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="@if(!empty(Auth::user()->avatar)) {{asset('storage/'.Auth::user()->avatar)}} @else https://avatars.dicebear.com/api/initials/{{ Auth::user()->name  ?? null}}.svg?margin=10 @endif" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="" class="d-block">{{ Auth::user()->name ?? null}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="" class="nav-link @if(request()->routeIs('dashboard.dashboard.index')) active @endif">
                <i class='bx bx-tachometer col-3 bx-tada-hover' ></i>
                <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                <i class='bx bxl-chrome col-3 bx-tada-hover' ></i>
                <p>Buka Landingpage </p>
                </a>
            </li>

            <li class="nav-header">MENU ADMIN</li>

                @if(Auth::user()->hasRole([
                    \App\Enums\RoleEnum::SuperAdmin,
                    \App\Enums\RoleEnum::Teacher,
                ]))
                <li class="nav-item">
                <a href="{{ route('teacher.materi.index') }}" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.menu')) active @endif">
                    <i class="bx bx-menu col-3 bx-tada-hover"></i>
                    <p>
                    Materi
                    </p>
                </a>
                </li>

                <li class="nav-item">
                <a href="" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.banner')) active @endif">
                    <col class="row">
                    <i class='bx  bx-signal-4 col-3 bx-tada-hover'  ></i> 
                    <p>
                    Leaderboard
                    </p>
                    </col>
                </a>
                </li>
                
                <li class="nav-item">
                <a href="" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.berita')) active @endif">
                    <col class="row">
                    <i class="bx bx-news col-3 bx-tada-hover"></i>
                    <p>
                    Forum Diskusi
                    </p>
                    </col>
                </a>
                </li>

                <li class="nav-item">
                <a href="" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.user')) active @endif">
                    <i class='bx bx-user col-3 bx-tada-hover'></i>
                    <p>
                    User
                    </p>
                </a>
                </li>
                
                <li class="nav-item">
                <a href="" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.pengaturan')) active @endif">
                    <i class="bx bx-cog col-3 bx-tada-hover"></i>
                    <p>
                    Pengaturan
                    </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/dashboard/user-activity" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.log')) active @endif">
                    <i class="bx bx-history col-3 bx-tada-hover"></i>
                    <p>
                    Log
                    </p>
                </a>
                </li>
            @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>