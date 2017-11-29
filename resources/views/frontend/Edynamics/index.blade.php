@extends('layouts/frontend/Edynamics/main')
@section('content') 
<section>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-top:50px;" >
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/frontend/Edynamics/img/BA-banner.jpg" alt="Image">  
            </div>
            <div class="item">
                <img src="/frontend/Edynamics/img/BA-banner1.jpg" alt="Image">     
            </div>
            <div class="item">
                <img src="/frontend/Edynamics/img/BA-banner3.jpg" alt="Image">    
            </div>
        </div>
        <a class="left carousel-control" id="left"  ng-non-bindable  role="button" data-slide="prev" >
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" id="right" ng-non-bindable  role="button" data-slide="next" >
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--<div id="main-slide" class="carousel slide default "   data-ride="carousel">
        <div class="carousel-inner ">
            <div class="overlay"></div>
            <div class="item active">
                <img class="img-responsive" src="/frontend/Edynamics/img/BA-banner.jpg" alt="slider"/>
                <div class="carousel-caption">
                    <div class="text  wow animated fadeInLeft" >  Reduce Dead Investment, Invest analytically.</div>
                </div>
            </div>
            <div class="item"> <img class="img-responsive" src="/frontend/Edynamics/img/BA-banner1.jpg" alt="slider"> 
                <div class="carousel-caption">
                    <div class="text wow animated slideInUp" >BMS on Google cloud Platform Secure, Quick and Easy to implement.</div>
                </div>
            </div>
            <div class="item"> 
                <img class="img-responsive" src="/frontend/Edynamics/img/BA-banner3.jpg" alt="slider">
                <div class="carousel-caption">  
                    <div class="text  wow animated fadeInRight" > BMS allows your team to respond faster & increase productivity.</div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" ng-non-bindable data-slide="prev"> <span><i class="fa fa-angle-left"></i></span> </a> <a class="right carousel-control" ng-non-bindable data-slide="next"> <span><i class="fa fa-angle-right"></i></span> </a>
    </div>-->
</section>
<div class="skewed-bg">
    <div class="content">
        <h1 class="title wow fadeInUp"  data-wow-delay="0.2s">Welcome to edynamics</h1>
        <p ><h2 class="text white-text wow fadeInUp"  data-wow-delay="0.4s">We are dedicated to simplify your business!</h2></p>
        <button class="btn btn-white  btn-default bold font-bold mr-5" > Read More </button>    <button class="btn btn-default btn-white font-bold" > Join Us Now </button>
    </div>
</div>

<section class="iconic">
    <div class="container">


        <div class="divider-new pt-5 fadeInLeft wow"   data-wow-duration="2s" data-wow-delay="5s">
            <h2 class="h2-responsive wow fadeIn m0">About edynamics</h2>
        </div>


        <p class="text-center testimonial-subhead ">Simplifying Business !</p>
        <div class="row">
            <div class="col-md-4 col-xs-12 col-lg-4 col-sm-6 wow fadeInUp"  data-wow-delay="0.2s">
                <!--Image Card-->
                <div class="card hoverable">
                    <div class="card-image">
                        <div class="view  hm-white-slight z-depth-1">
                            <img src="/frontend/Edynamics/img/bg12.jpg" class="img-responsive" alt="">
                            <a href="#">
                                <div class="mask waves-effect"></div>
                            </a>
                        </div>
                    </div>
                    <div class="card-content">
                        <h5>Who Are We ?</h5>
                        <p>edynamics serves clients to earn maximum profit using minimum resources by providing a unique network and services that put data efficiently for smarter and better use. </p>
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="#" class="btn btn-default btn-md waves-effect waves-light">Read more</a>

                    </div>
                    <!--/.Buttons-->
                </div>
                <!--Image Card-->
            </div>
            <div class="col-md-4 col-xs-12 col-lg-4 col-sm-6 wow fadeInUp"  data-wow-delay="0.4s">
                <!--Image Card-->
                <div class="card hoverable">
                    <div class="card-image">
                        <div class="view  hm-white-slight z-depth-1">
                            <img src="/frontend/Edynamics/img/bg13.jpg" class="img-responsive" alt="">
                            <a href="#">
                                <div class="mask waves-effect"></div>
                            </a>
                        </div>
                    </div>
                    <div class="card-content">
                        <h5>Our Products</h5>
                        <p>
                            Let us make your job easier. We have a team of engineers and expertise to provide you a system for the systematic and effective solution to simplify your day-to-day activities</p>
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="#" class="btn btn-default btn-md waves-effect waves-light">Read more</a>

                    </div>
                    <!--/.Buttons-->
                </div>
                <!--Image Card-->
            </div>
            <div class="col-md-4 col-xs-12 col-lg-4 col-sm-6 wow fadeInUp"  data-wow-delay="0.6s">
                <!--Image Card-->
                <div class="card hoverable">
                    <div class="card-image">
                        <div class="view  hm-white-slight z-depth-1">
                            <img src="/frontend/Edynamics/img/bg4.jpg" class="img-responsive" alt="">
                            <a href="#">
                                <div class="mask waves-effect"></div>
                            </a>
                        </div>
                    </div>
                    <div class="card-content">
                        <h5>Work With Us !</h5>
                        <p>We are the inventors and developers of <b>BMS system</b>. We are a fast growing, leading company specializing in providing Business Management Systems to real estate industry. </p>
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="#" class="btn btn-default btn-md waves-effect waves-light">Read more</a>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<div class="sticky-container">
    <ul class="stickyBTN">
        <li>
            <i class="fa fa-facebook"></i>
            <p>Facebook</p>
        </li>
        <li>
            <i class="fa fa-twitter"></i>
            <p>Twitter</p>
        </li>
        <li>
            <i class="fa fa-google-plus"></i>
            <p>Google+</p>
        </li>

    </ul>
</div>

<section class="testimonial-section  hide wow fadeInUp delay-02s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class=" wow fadeInUp delay-02s">Customers Words</h3>
                <div class="owl-carousel  awards owl-theme">
                    <div class="col-lg-12">
                        <div class="testimonials">
                            <div class="col-lg-12">
                                <div class="testimonialsC"> Best Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the Yea </div>
                                <div class="timaget">
                                    <div class="tphoto pull-left"><img src="/frontend/Edynamics/img/avatar2_large.png" class="img-circle"/> </div>
                                    <div class="tname pull-right">
                                        <p>Mr. dshfds fhsdj fs</p>
                                        <p><strong>CEO</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="testimonials">
                            <div class="col-lg-12">
                                <div class="testimonialsC"> Best Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the Yea </div>
                                <div class="timaget">
                                    <div class="tphoto pull-left"> <img src="/frontend/Edynamics/img/avatar2_large.png" class="img-circle"/></div>
                                    <div class="tname pull-right">
                                        <p>Mr. dshfds fhsdj fs</p>
                                        <p><strong>CEO</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="testimonials">
                            <div class="col-lg-12">
                                <div class="testimonialsC"> Best Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the Yea </div>
                                <div class="timaget">
                                    <div class="tphoto pull-left"> <img src="/frontend/Edynamics/img/avatar2_large.png" class="img-circle"/></div>
                                    <div class="tname pull-right">
                                        <p>Mr. dshfds fhsdj fs</p>
                                        <p><strong>CEO</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="testimonials">
                            <div class="col-lg-12">
                                <div class="testimonialsC"> Best Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the YeaBest Real Estate Consultant of the Yea </div>
                                <div class="timaget">
                                    <div class="tphoto pull-left"> <img src="/frontend/Edynamics/img/avatar2_large.png" class="img-circle"/> </div>
                                    <div class="tname pull-right">
                                        <p>Mr. dshfds fhsdj fs</p>
                                        <p><strong>CEO</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Start testimonials Section -->
<section class="testimonial-section parallax-container">

    <div class="container">
        <h3 class="text-center mb0 wow fadeInUp delay-02s mb0 ">Customers Words</h3>
        <p class="text-center testimonial-subhead">What our clients say</p>
        <div class="owl-carousel clients-say  owl-theme">
            <div class="item  wow  slideInLeft delay-01s">
                <div class="col-lg-12 col-md-12">

                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="https://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Anna Maria</h5>
                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci, voluptatum placeat ducimus vero commodi provident culpa accusamus nostrum dolor, labore ratione eius.</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="item   wow  slideInLeft delay-06s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="https://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Anna Maria</h5>
                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci, voluptatum placeat ducimus vero commodi provident culpa accusamus nostrum dolor, labore ratione eius.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-12s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="https://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Anna Maria</h5>
                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci, voluptatum placeat ducimus vero commodi provident culpa accusamus nostrum dolor, labore ratione eius.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-16s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="https://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Anna Maria</h5>
                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci, voluptatum placeat ducimus vero commodi provident culpa accusamus nostrum dolor, labore ratione eius.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-18s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="https://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Anna Maria</h5>
                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci, voluptatum placeat ducimus vero commodi provident culpa accusamus nostrum dolor, labore ratione eius.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="parallax"><img src="/frontend/Edynamics/img/b2.jpg" alt="Unsplashed background img 1"></div>
</section>


<div class="footertopred">
</div>     
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection()
<script>
    $(document).ready(function () {
        $('.carousel-control.left').click(function () {
            alert("fdfd")
            $('#myCarousel').carousel('prev');
        });
        $('#left').click(function () {
            alert("fdfd")
            $('#myCarousel').carousel('prev');
        });


        $('.carousel-control.right').click(function () {
            $('#myCarousel').carousel('next');
        });

    });
    $(document).ready(function () {
        setTimeout(function () {
            $('#myCarousel').carousel('next');
        }, 5000);
    });
</script>