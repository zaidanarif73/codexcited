@if(Auth::user()->hasRole([
        \App\Enums\RoleEnum::Teacher,
    ]))
<!DOCTYPE html>
<html lang="en">
    @include('teacher.layouts.head')
    @trixassets
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('sweetalert::alert')
        @include('teacher.layouts.topbar')
        @include('teacher.layouts.sidebar')
        <div class="content-wrapper">
            @include('teacher.components.breadcumb')
            <section class="content">
                <div class="container-fluid">
                    @yield("content")
                </div>
            </section>
        </div>
    </div>
    @include('teacher.layouts.script')
</body>
</html>
@else
    <p>Acces Denied!</p>
@endif
