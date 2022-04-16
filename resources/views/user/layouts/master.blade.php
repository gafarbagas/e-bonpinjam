<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    @include('user.includes.style')
    @yield('style')

</head>

<body id="page-top">
    
    <!-- Navigation -->
    @include('user.includes.navbar')

    <!-- Page Content -->
    <div class="bg-grey content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('user.includes.footer')

    <!-- Bootstrap core JavaScript -->
    @include('user.includes.script')

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @yield('script')
    @include('sweetalert::alert')

</body>

</html>
