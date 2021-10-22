<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Training - ICPC Minya University</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/01.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/01.png')}}" type="image/x-icon"/>

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/index">ICPC Minya University</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="/index" class="logo me-auto"><img style="width: 90px" src="assets/img/01.png" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="/index">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/training">Training</a></li>
                <li><a href="/events">Events</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="/training" class="get-started-btn">Get Started</a>

    </div>
</header><!-- End Header -->

<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h2>Trainings</h2>
            <p>If you interested in learning Problem Solving Skills you can apply here for our trainings. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
        <div class="container" data-aos="fade-up">

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach($trainings as $training)

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="course-item">
                            <a href="{{URL::route('training-details', [$training->id]) }}"> <img
                                    src="{{asset('Trainings/'.$training['img'])}}" style="height: 400px;width: 400px"
                                    class="img" alt="..."></a>
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>{{$training['tag']}}</h4>

                                </div>

                                <h3>
                                    <a href="{{URL::route('training-details', [$training->id]) }}">{{$training['name']}}</a>
                                </h3>
                                <p>{{$training['description']}}</p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        <img src="{{asset('Members/'.$training->item['img'])}} "
                                             style="height: 70px; width: 50px" class="img-fluid" alt="">
                                        <span>{{$training->item['name']}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- End Course Item-->

            </div>

        </div>
    </section><!-- End Courses Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">


    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>NeVeDlE</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Edited by <a href="https://github.com/NeVeDlE">NeVeDlE</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://www.facebook.com/icpcminya" class="facebook"><i class="bx bxl-facebook"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/purecounter/purecounter.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="/assets/js/main.js"></script>

</body>

</html>
