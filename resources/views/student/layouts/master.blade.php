@if(Auth::user()->hasRole([
        \App\Enums\RoleEnum::Student,
    ]))
<!DOCTYPE html>
<html lang="en">
@include("student.layouts.head")
<body>
    @include('sweetalert::alert')
    <!-- spinner -->
    {{-- @include("student.components.spinner") --}}

    <!-- navbar -->
    @include("student.layouts.navbar")

    <!-- main -->
    <main class="main">
        @yield("content")
    </main>

    <!-- footer -->
    {{-- @include("student.layouts.footer") --}}

    <!-- script -->
    @include("student.layouts.script")
</body>

</html>
@else
    <p>Acces Denied!</p>
@endif