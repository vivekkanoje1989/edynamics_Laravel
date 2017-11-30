@extends('layouts/frontend/Edynamics/main')
@section('content') 
<section>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
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
</section>
<div class="skewed-bg">
    <div class="content">
        <h1 class="title wow fadeInUp"  data-wow-delay="0.2s">Welcome to edynamics</h1>
        <p ><h2 class="text white-text wow fadeInUp"  data-wow-delay="0.4s">We are dedicated to simplify your business!</h2></p>
        <a class="btn btn-white    btn-default bold font-bold mr-5" href="[[ URL::to('/') ]]/about" > Read More </a>    <a class="btn btn-default btn-white font-bold" href="[[ URL::to('/') ]]/contact"> Join Us Now </a>
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
                      <p><b>edynamics</b> serves clients to earn maximum profit using minimum resources by providing a unique network and services that put data efficiently for smarter and better use. We are a <b>Google partner</b> company, making business ideas easier and better informed. We are here to save your time, money and simplify your business.</p>    
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="[[ URL::to('/') ]]/about" class="btn btn-default btn-md waves-effect waves-light">Learn more</a>

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
Let us make your job easier. We have a team of engineers and expertise to provide you a system for the systematic and effective solution to simplify your day-to-day activities and sales process. Our<a class="index-a" href="/index.php/builder-crm-software-products"> Business Management System </a>helps our clients to have a better control on their business and operational activities through e-governance. </p>    
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="[[ URL::to('/') ]]/products" class="btn btn-default btn-md waves-effect waves-light">Learn more</a>

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
                        <p>We are the inventors and developers of <b>BMS system</b>. We are a fast growing, leading company specializing in providing Business Management Systems to real estate industry. We are a team of self-driven, energetic and disciplined people. If you have the same passion with experience in sales, marketing, programming and designing then join us to grow together as a unit to simplify the business.</p>   
                    </div>
                    <!--Buttons-->
                    <div class="card-btn text-center">
                        <a href="[[ URL::to('/') ]]/partnership" class="btn btn-default btn-md waves-effect waves-light">Learn more</a>

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
                        <div class="avatar"><img src="/frontend/Edynamics/client/sameer.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Sameer Gholve </h5>
                            <small>Managing Director</small>
                            <h6><b>Primary Housing Corporation</b></h6>
                            <p><i class="fa fa-quote-left"></i>Technology is supposed to make the job easy but if not designed well
                                it can be the biggest source of inconvenience.  edynamics product is not just technically strong but also extremely user-friendly.
                                It is designed/developed keeping the user at the center.</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="item   wow  slideInLeft delay-06s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/vitthal.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Vitthal Ranawade </h5>
                            <small>Managing Director</small>
                            <h6><b>SR group</b></h6>
                            <p><i class="fa fa-quote-left"></i>Just to say we are really impressed with the ways you sorted the things for us. We are appreciated that the things are explained from you is clear and easy to understand.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-12s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/kunal.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Kunal Prasad </h5>
                            <small>Marketing Head</small>
                            <h6><b>PropZapper</b></h6>
                            <p><i class="fa fa-quote-left"></i> BMS is a very useful & smart tool. After using it for more than a year now, 
                                we can’t even think of managing our CRM & Lead Administration without it.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-16s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/vipul.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Vipul Bhavani</h5>
                            <small>Managing Director</small>
                            <h6><b>Vision Creative Group</b></h6>
                            <p><i class="fa fa-quote-left"></i> 
                                I don't demand any reports to my staff now, BMS does it for me automatically.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-18s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/rajshah.png" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Raj Shah</h5>
                            <small>Director Sales & Marketing</small>
                            <h6><b>Namrata Group</b></h6>
                            <p><i class="fa fa-quote-left"></i> BMS delivers very good results & helping us managing our day to day tasks very well.
                                It also gives confidence to our employees so that they can focus on there core tasks. 
                                Automatic upgrades and getting new tools every month is again great experience we are enjoying.			
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="item   wow  slideInLeft delay-18s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/kiran.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Kiran Nighot </h5>
                            <small>General Manager</small>
                            <h6><b>Aarohi Developers</b></h6>
                            <p><i class="fa fa-quote-left"></i> 
                                We would like to thank and appreciate edynamics effort's in providing various good tool's which help us connecting with our clients properly.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item   wow  slideInLeft delay-18s">
                <div class="col-lg-12 col-md-12">
                    <div class="testimonial-card z-depth-1">
                        <div class="card-up tstmonialsbg-transform default-color-dark">
                        </div>
                        <div class="avatar"><img src="/frontend/Edynamics/client/sambhaji.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="card-content">
                            <h5>Sambhaji Magar</h5>
                            <small>Managing Director</small>
                            <h6><b>Poona Properties</b></h6>
                            <p><i class="fa fa-quote-left"></i> 
                                Business is excellent now a days, felt the difference of doing business with help of technology.
                                BMS is delivering excellent for us every day.
                            </p>
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
@endsection()

<script>

    $('.carousel-control.left').click(function () {
        $('#myCarousel').carousel('prev');
    });
    $('#left').click(function () {
        $('#myCarousel').carousel('prev');
    });


    $('.carousel-control.right').click(function () {
        $('#myCarousel').carousel('next');
    });


    $(document).ready(function () {
        setTimeout(function () {
            $('#myCarousel').carousel('next');
        }, 5000);
    });
    
</script>
<script>
$("#recentItem").click(function(){
$(".recentItem").animate({
right: '0'	 
});
$(".overlay").addClass("show");

});

$(".closX").click(function(){
$(".recentItem").animate({
right: '-300px'	
}); 
$(".overlay").removeClass("show");
});

$(".overlay").click(function(){
$(".recentItem").animate({
right: '-300px'	
}); 
$(".overlay").removeClass("show");
});
</script>