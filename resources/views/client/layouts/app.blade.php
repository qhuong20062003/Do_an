<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Coron - Fashion eCommerce Bootstrap4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets\img\favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('client\assets\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client\assets\css\plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('client\assets\css\bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('client\assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('client\assets\css\responsive.css') }}">
    <script src="{{ asset('client\assets\js\vendor\modernizr-2.8.3.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Add your site or application content here -->

    <!--pos page start-->
    <div class="pos_page">
        <div class="container">
            <!--pos page inner-->
            <div class="pos_page_inner">
                <!--header area -->
                @include('client.layouts.header')
                <!--header end -->

                <!--pos home section-->
                @yield('content')
                <!--pos home section end-->
                
                <!--footer area start-->
                @include('client.layouts.footer')
                <!--footer area end-->
                
            </div>
            <!--pos page inner end-->
        </div>
    </div>
    <!--pos page end-->

    
    <!-- all js here -->
    <script src="{{ asset('client\assets\js\vendor\jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('client\assets\js\popper.js') }}"></script>
    <script src="{{ asset('client\assets\js\bootstrap.min.js') }}"></script>
    <script src="{{ asset('client\assets\js\ajax-mail.js') }}"></script>
    <script src="{{ asset('client\assets\js\plugins.js') }}"></script>
    <script src="{{ asset('client\assets\js\main.js') }}"></script>
</body>

</html>