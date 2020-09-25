<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>
        لوحة التحكم
        |
        @yield('title')
    </title>

    <!-- Fontfaces CSS-->
{{--    <link href="css/font-face.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/css/font-face.css') !!}
{{--    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') !!}
{{--    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') !!}
{{--    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') !!}
    <!-- Bootstrap CSS-->
{{--    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/bootstrap-4.1/bootstrap.min.css') !!}
    <!-- Vendor CSS-->
{{--    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/animsition/animsition.min.css') !!}
{{--    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') !!}
{{--    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/wow/animate.css') !!}
{{--    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/css-hamburgers/hamburgers.min.css') !!}
{{--    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/slick/slick.css') !!}
{{--    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/select2/select2.min.css') !!}
{{--    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') !!}
    <!-- Main CSS-->
{{--    <link href="css/theme.css" rel="stylesheet" media="all">--}}
    {!! Html::style('admin/css/theme.css') !!}


    {!! Html::style('admin/css/AdminLTE/AdminLTE.css') !!}
    {!! Html::style('admin/css/AdminLTE/_all-skins.min.css') !!}



    @yield('header')

</head>

<body class="animsition">

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    @include('admin_panel.layouts.header_mobile')
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    @include('admin_panel.layouts.menu_sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('admin_panel.layouts.header_desktop')
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">


                    @yield('content')



                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
{{--<script src="admin/vendor/jquery-3.2.1.min.js"></script>--}}
{!! Html::script('admin/vendor/jquery-3.2.1.min.js') !!}
<!-- Bootstrap JS-->
{{--<script src="admin/vendor/bootstrap-4.1/popper.min.js"></script>--}}
{!! Html::script('admin/vendor/bootstrap-4.1/popper.min.js') !!}

{{--<script src="admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>--}}
{!! Html::script('admin/vendor/bootstrap-4.1/bootstrap.min.js') !!}

<!-- Vendor JS       -->

{{--<script src="admin/vendor/slick/slick.min.js"></script>--}}
{!! Html::script('admin/vendor/slick/slick.min.js') !!}

{{--<script src="admin/vendor/wow/wow.min.js"></script>--}}
{!! Html::script('admin/vendor/wow/wow.min.js') !!}

{{--<script src="admin/vendor/animsition/animsition.min.js"></script>--}}
{!! Html::script('admin/vendor/animsition/animsition.min.js') !!}

{{--<script src="admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>--}}
{!! Html::script('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') !!}

{{--<script src="admin/vendor/counter-up/jquery.waypoints.min.js"></script>--}}
{!! Html::script('admin/vendor/counter-up/jquery.waypoints.min.js') !!}

{{--<script src="admin/vendor/counter-up/jquery.counterup.min.js"></script>--}}
{!! Html::script('admin/vendor/counter-up/jquery.counterup.min.js') !!}

{{--<script src="admin/vendor/circle-progress/circle-progress.min.js"></script>--}}
{!! Html::script('admin/vendor/circle-progress/circle-progress.min.js') !!}

{{--<script src="admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>--}}
{!! Html::script('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') !!}

{{--<script src="admin/vendor/chartjs/Chart.bundle.min.js"></script>--}}
{!! Html::script('admin/vendor/chartjs/Chart.bundle.min.js') !!}

{{--<script src="admin/vendor/select2/select2.min.js"></script>--}}
{!! Html::script('admin/vendor/select2/select2.min.js') !!}

<!-- Main JS-->
{{--<script src="admin/js/main.js"></script>--}}
{!! Html::script('admin/js/main.js') !!}




@yield('footer')

</body>

</html>
<!-- end document-->
