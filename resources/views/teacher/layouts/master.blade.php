@if(Auth::user()->hasRole([
        \App\Enums\RoleEnum::Teacher,
    ]))
<!DOCTYPE html>
<html lang="en">
@include("teacher.layouts.head")
<body>
    @include('sweetalert::alert')
    <!-- spinner -->
    {{-- @include("teacher.components.spinner") --}}

    <!-- navbar -->
    {{-- @include("teacher.layouts.navbar") --}}

    <!-- main -->
    <main class="main">
        @yield("content")
    </main>

    <!-- footer -->
    {{-- @include("teacher.layouts.footer") --}}

    <!-- script -->
    {{-- @include("teacher.layouts.script") --}}
</body>

</html>
@else
    <p>Acces Denied!</p>
@endif