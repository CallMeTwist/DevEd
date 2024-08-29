<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken">
    <!-- Page Title -->
    <title>Deved</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/devedlogo.svg">
    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="/assets/css/slicknav.min.css" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <!-- Font Awesome Icon Css-->
    <link href="/assets/css/all.css" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="/assets/css/animate.css" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- Main Custom Css -->
    <link href="/assets/css/custom.css" rel="stylesheet" media="screen">
</head>
<body class="tt-magic-cursor">

<!-- Preloader Start -->
<div class="preloader">
    <div class="loading-container">
        <div class="loading"></div>
        <div id="loading-icon"><img src="/assets/images/devedloader.svg" alt=""></div>
    </div>
</div>
<!-- Preloader End -->

<!-- Magic Cursor Start -->
<div id="magic-cursor">
    <div id="ball"></div>
</div>
<!-- Magic Cursor End -->

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="./">
                    <img src="/assets/images/Deved8.svg" alt="Logo">
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">about us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">services</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('portfolios.index') }}">portfolio</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('blogs.index') }}">blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('FAQs') }}">FAQ</a></li>
                        </ul>
                    </div>
                    <!-- Let’s Start Button Start -->
                    <div class="header-btn d-inline-flex">
                        <a href="{{ route('contact.page') }}" class="btn-default">Contact Us</a>
                    </div>
                    <!-- Let’s Start Button End -->
                </div>
                <!-- Main Menu End -->

                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->

{!! $slot !!}

<!-- Footer Start -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Mega Footer Start -->
                <div class="mega-footer">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- Footer About Start -->
                            <div class="footer-about">
                                <figure>
                                    <img src="/assets/images/deved8.svg" alt="">
                                </figure>
                                <p>Lets Build Something Amazing..</p>
                                <ul>
                                    <li><a href="#">{{ strtolower(get_settings()->email) }}.</a></li>
                                    <li><a href="#">{{ get_settings()->phone }}.</a></li>
                                </ul>
                            </div>
                            <!-- Footer About End -->
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h2>pages</h2>
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('services.index') }}">Services</a></li>
                                    <li><a href="{{ route('blogs.index') }}">Blog</a></li>
                                    <li><a href="{{ route('contact.page') }}">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h2>Socials</h2>
                                <ul>
                                    <li><a href="#">instagram</a></li>
                                    <li><a href="#">facebook</a></li>
                                    <li><a href="#">twitter</a></li>
                                    <li><a href="#">linkedin</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h2>services</h2>
                                <ul>
                                    <li><a href="#">web development</a></li>
                                    <li><a href="#">digital marketing</a></li>
                                    <li><a href="#">game development</a></li>
                                    <li><a href="#">mobile app development</a></li>
                                    <li><a href="#">networking services</a></li>
                                </ul>
                            </div>
                            <!-- Footer Links End -->
                        </div>
                    </div>
                </div>
                <!-- Mega Footer End -->

                <!-- Copyright Footer Start -->
                <div class="footer-copyright">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <!-- Footer Copyright Content Start -->
                            <div class="footer-copyright-text">
                                <p>Copyright © 2024 {{ get_settings()->name }}. All rights reserved.</p>
                            </div>
                            <!-- Footer Copyright Content End -->
                        </div>
                        <div class="col-lg-6">
                            <!-- Footer Policy Links Start -->
                            <div class="footer-policy-links">
                                <ul>
                                    <li><a href="#">privacy policy</a></li>
                                    <li><a href="#">terms of service</a></li>
                                    <li class="highlighted"><a href="#top">go to top</a></li>
                                </ul>
                            </div>
                            <!-- Footer Policy Links End -->
                        </div>
                    </div>
                </div>
                <!-- Copyright Footer End -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

<!-- Jquery Library File -->
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js file -->
<script src="/assets/js/bootstrap.min.js"></script>
<!-- Validator js file -->
<script src="/assets/js/validator.min.js"></script>
<!-- SlickNav js file -->
<script src="/assets/js/jquery.slicknav.js"></script>
<!-- Swiper js file -->
<script src="/assets/js/swiper-bundle.min.js"></script>
<!-- Counter js file -->
<script src="/assets/js/jquery.waypoints.min.js"></script>
<script src="/assets/js/jquery.counterup.min.js"></script>
<!-- Isotop js file -->
<script src="/assets/js/isotope.min.js"></script>
<!-- Magnific js file -->
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<!-- SmoothScroll -->
<script src="/assets/js/SmoothScroll.js"></script>
<!-- MagicCursor js file -->
<script src="/assets/js/gsap.min.js"></script>
<script src="/assets/js/magiccursor.js"></script>
<!-- Text Effect js file -->
<script src="/assets/js/SplitText.js"></script>
<script src="/assets/js/ScrollTrigger.min.js"></script>
<!-- Wow js file -->
<script src="/assets/js/wow.js"></script>
<!-- Main Custom js file -->
<script src="/assets/js/function.js"></script>
</body>
</html>
