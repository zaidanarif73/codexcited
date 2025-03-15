<!DOCTYPE html>
<html lang="en">
@include("guest.layouts.head")
<body>
    @include('sweetalert::alert')
    <!-- spinner -->
    @include("guest.components.spinner")

    <!-- navbar -->
    @include("guest.layouts.navbar")

    <!-- main -->
    <main class="main">
        @yield("content")
    </main>

    <!-- footer -->
    @include("guest.layouts.footer")

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- script -->
    @include("guest.layouts.script")
</body>

</html>