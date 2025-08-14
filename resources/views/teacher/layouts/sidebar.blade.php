<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #23283a;">
    

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="@if(!empty(Auth::user()->avatar)) {{asset('storage/'.Auth::user()->avatar)}} @else https://avatars.dicebear.com/api/initials/{{ Auth::user()->name  ?? null}}.svg?margin=10 @endif" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('teacher.profile.index') }}" class="d-block">{{ Auth::user()->name ?? null}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('teacher.dashboard.index') }}" class="nav-link @if(request()->routeIs('teacher.dashboard.index')) active @endif">
                <i class='bx bx-tachometer col-3 bx-tada-hover' ></i>
                <p>Dashboard</p>
                </a>
            </li>
            
            <li class="nav-header">MENU ADMIN</li>

                @if(Auth::user()->hasRole([
                    \App\Enums\RoleEnum::SuperAdmin,
                    \App\Enums\RoleEnum::Teacher,
                ]))
                <li class="nav-item">
                <a href="{{ route('teacher.materi.index') }}" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'teacher.materi')) active @endif">
                    <i class="bx bx-menu col-3 bx-tada-hover"></i>
                    <p>
                    Materi
                    </p>
                </a>
                </li>

                <li class="nav-item">
                <a href="{{ route('teacher.leaderboard.index') }}" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'teacher.leaderboard')) active @endif">
                    <col class="row">
                    <i class='bx  bx-signal-4 col-3 bx-tada-hover'  ></i> 
                    <p>
                    Leaderboard
                    </p>
                    </col>
                </a>
                </li>
                
                <li class="nav-item">
                </li>

                <li class="nav-item">
                <a href="{{ route("teacher.user.index") }}" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'teacher.user')) active @endif">
                    <i class='bx bx-user col-3 bx-tada-hover'></i>
                    <p>
                    User
                    </p>
                </a>
                </li>
                
                {{-- <li class="nav-item">
                <a href="" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'dashboard.pengaturan')) active @endif">
                    <i class="bx bx-cog col-3 bx-tada-hover"></i>
                    <p>
                    Pengaturan
                    </p>
                </a>
                </li> --}}
                <li class="nav-item">
                <a href="{{ route('teacher.log.index') }}" class="nav-link @if(Str::startsWith(request()->route()->getName(), 'teacher.log')) active @endif">
                    <i class="bx bx-history col-3 bx-tada-hover"></i>
                    <p>
                    Aktivitas Siswa 
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