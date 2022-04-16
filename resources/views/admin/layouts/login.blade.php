<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    @include('admin.includes.style')

</head>

<body class="bg-gradient-brown">

    <div class="container">

        <!-- Outer Row -->
        @yield('content')

    </div>

    <!-- Bootstrap core JavaScript-->
    @include('admin.includes.script')

</body>

</html>