<!DOCTYPE html>
<html lang="en">
@include("student.layouts.head")
<body>
    <!-- spinner -->
    @include("student.components.spinner")

    <!-- navbar -->
    @include("student.layouts.navbar")

    <!-- main -->
    <main class="main">
        @yield("content")
    </main>

    <!-- footer -->
    @include("student.layouts.footer")

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- script -->
    @include("student.layouts.script")
</body>

</html>