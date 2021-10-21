<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Training Details - ICPC Minya University</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/01.png" rel="icon">
    <link href="/public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">


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
    <!---Internal Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Title -->

    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/01.png')}}" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <!--  Sidebar css -->
    <link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">

    <!--- Style css -->

    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/index">ICPC Minya University</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index" class="logo me-auto"><img style="width: 90px" src="/assets/img/01.png" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="/index">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/training">training</a></li>
                <li><a href="/events">Events</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="training" class="get-started-btn">Get Started</a>

    </div>
</header><!-- End Header -->

<main id="main">

<!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Training Details</h2>
            <p>Check the suitable train for you and apply for it. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <img src="{{asset('Trainings/'.$training['img'])}}" style="height: 700px;width: 900px"
                         class="img-fluid" alt="">
                    <h3>{{$training['name']}}</h3>
                    <p style="font-size: 30px">
                        What you are going to learn in this Training:
                    </p>
                    <ul style="font-size: 20px">
                        @foreach($training['topics'] as $topic)
                            <li class="">{{$topic}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainer</h5>
                        <p>{{$training->item['name']}}</p>
                    </div>


                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Schedule</h5>
                        <p>{{$training['date']}}</p>
                    </div>
                    <div class="course-info d-flex justify-content-between align-items-center">

                        <a class="modal-effect btn btn-success btn-block" style="color: white" data-target="#modaldemo1"
                           data-toggle="modal" href="">Sign Up</a>


                    </div>

                </div>
            </div>

        </div>

    </section><!-- End Cource Details Section -->


</main><!-- End #main -->

<!-- Basic modal -->

<div class="modal" id="modaldemo1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Register</h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{route('requests.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Full Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="">Codeforces Handle (If Found) :</label>
                        <input type="text" class="form-control" id="handle" name="handle">
                    </div>
                    <div class="form-group">
                        <label for="">National ID ( الرقم القومي ) : </label>
                        <input type="text" class="form-control" required id="national" name="national">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" required id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">University:</label>
                        <select name="university" id="university" class="form-control" required>
                            <option selected="true" disabled="disabled" value="">--Choose Your University--</option>
                            <option value="1">Minya</option>
                            <option value="2">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Faculty:</label>
                        <select name="faculty" id="faculty" class="form-control" required>
                            <option selected="true" disabled="disabled" value="">--Choose Your Faculty--</option>
                            <option value="1">Faculty of Computers and Information</option>
                            <option value="2">Faculty of Science</option>
                            <option value="3">Faculty of Engineering</option>
                            <option value="4">Faculty of Specific Education</option>
                            <option value="5">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Training:</label>
                        <select name="training" id="training" class="form-control" required>
                            <option selected="true" value="{{$training['id']}}">{{$training['name']}}</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">College Year:</label>
                        <select name="year" id="year" class="form-control" required>
                            <option selected="true" disabled="disabled">--Choose Year--</option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit">Register</button>
                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Basic modal -->
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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/purecounter/purecounter.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<!--Internal  Datepicker js -->

<!-- Template Main JS File -->
<script src="/assets/js/main.js"></script>
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>

<!-- Sticky js -->
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>
</body>

</html>

