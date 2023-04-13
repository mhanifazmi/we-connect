<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Explore a diverse range of user links and URLs all in one convenient location! From social media profiles and personal websites to blogs and online portfolios, discover the wealth of content that users have to offer. Visit now to access a comprehensive collection of links and explore the web like never before.">
    <meta name="keywords" content="connect, link, url, mhanifazmi">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>We Connect | mhanifazmi.com</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    @includeIf('layouts.css')
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @if (auth()->check())
            @includeIf('layouts.header')
        @endif
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            {{-- @includeIf('layouts.sidebar') --}}
            <!-- Page Sidebar Ends-->
            <div class="page-body"
                style="background-image: url('{{ $image }}'); height: 100%; background-repeat: no-repeat; background-size: cover;">
                <!-- Container-fluid starts-->
                <div class="glass"></div>
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @includeIf('layouts.footer')
        </div>
    </div>
    <!-- latest jquery-->
    @includeIf('layouts.scripts')
    <!-- login js-->
    <!-- Plugin used-->
    <!-- Code injected by live-server -->
</body>

</html>
