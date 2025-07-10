<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/teacher/plugins/summernote/summernote-bs4.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{URL::to('/')}}/assets/images/logo/favicon.png">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- css yudo-->
        <link href="{{URL::to('/')}}/assets/teacher/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{URL::to('/')}}/assets/teacher/css/icons.css" rel="stylesheet" type="text/css">
        <link href="{{URL::to('/')}}/assets/teacher/css/style.css" rel="stylesheet" type="text/css">

        <!-- Select2 -->
        <link rel="stylesheet" href="{{URL::to('/')}}/templates/dashboard/assets/plugins/bootstrap-select2/select2.min.css" />
        <link rel="stylesheet" href="{{URL::to('/')}}/templates/dashboard/assets/plugins/bootstrap-select2/select2-bootstrap.min.css">
    <!--end css yudo-->
    
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">  

    @yield("css")
</head>