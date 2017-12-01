@extends('layouts/frontend/Edynamics/main')
@section('content') 
<div id="index-banner" class="parallax-container parallax-cont-skew ">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="pagename">
                <h2 class="header center teal-text text-lighten-2">Contact Us</h2>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="/frontend/Edynamics/img/about-us-banner.jpg" alt="Unsplashed background img 1"></div>
    <div class="skewed-bg-inn">
        <div class="content container">
            <div>Home - Contact Us</div>
        </div>
    </div>
</div>
</section>
<section class="iconic">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="divider-new pt-5" >
                    <h2 class="h2-responsive  blue-text wow fadeIn ">Get In Touch </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center  col-lg-6 col-xs-12 col-sm-12">
                <h4 class="red-text bg-gray p5 m0 text-center">ADDRESS</small></h4>
                <address class="mt20">
                    <strong><b>edynamics (H.O. Pune)</b></strong>
                    <p>No 5, Richmond Park,</p>
                    <p>Opp. Orchid School, Baner Road,</p>
                    <p>Near Balewadi Phata, Baner, </p>
                    <p>Pune, Maharashtra 411045</p>
                </address>  
                <hr/>
                <address>
                    <strong><b>edynamics (R.O. Bangalore)</b></strong>  
                    <p>  19, Third Floor, R I Towers,</p>
                    <p> Queens Road, Next to Gold Star Hotel,</p>
                    <p> Near Indian Express Building, Vasanth Nagar,</p>
                    <p> Bengaluru, Karnataka 560052</p>
                </address>
            </div>
            <div class="col-md-6  col-lg-6 col-xs-12 col-sm-12">
                <p class="red-bg-whttxt">FEEL FREE TO CONTACT US <small>( * MANDATORY FIELDS )</small></p>
                <div class="alert alert-success" ng-if="successMssg">
                    <strong>Thank you for contacting us</strong>
                </div>
                <div class=" partner-form p15 bg-gray">
                    <form novalidate name="contactUs" ng-submit="contactUs.$valid && doContactAction(contact)" >
                        <div class="md-form">
                            <i class="fa fa-user prefix"></i>
                            <input type="text" ng-model="contact.first_name" name="first_name" class="form-control" required>
                            <label for="name">Your name *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.first_name.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa  fa-building prefix"></i>
                            <input type="text" name="company" ng-model="contact.company" id="contact-company" class="form-control" required> 
                            <label for="contact-company">Company *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.company.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-envelope prefix"></i>
                            <input type="email" name="email_id" ng-model="contact.email_id" id="email_id" class="form-control validate" required>
                            <label for="email" data-error="wrong" >Your email *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.email_id.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-mobile-phone prefix"></i>
                            <input type="number" id="mobile_number" ng-model="contact.mobile_number" class="form-control validate" maxlength="10" required>
                            <label for="mobile-no" data-error="wrong" >Your Mobile Number *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.mobile_number.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-pencil prefix"></i>
                            <textarea type="text" id="message" ng-model="contact.message" class="md-textarea" required></textarea>
                            <label for="message">Textarea *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.message.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="text-xs-center text-center">
                            <button class="btn btn-default mb-2 waves-effect waves-light" ng-disabled="contactBtndisabled" ng-click="sbtBtn = true;">Send <i class="fa fa-send ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="googlemap" class="testimonial-section parallax-container">
    <div class="container">
        <div class="row">
            <h3 class="text-center mb0 wow fadeInUp delay-02s mb0">Google Map</h3>
            <div class="col-md-6  col-lg-6 col-xs-12 col-sm-12"> 
                <p class="font-bold text-center">edynamics (H.O. Pune)</p> 
                <div id="map1" class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.2183690546035!2d73.77942745105693!3d18.564191337321645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2becdc1d67b2b%3A0xd7eddb46e6814db5!2sedynamics+(H.O.+Pune)!5e0!3m2!1sen!2sin!4v1512013440623" width="500" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>

            </div>
            <div class="col-md-6  col-lg-6 col-xs-12 col-sm-12">
                <p class="font-bold text-center">edynamics (R.O. Bangalore)</p> 
                <div id="map2" class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.787532995964!2d77.59536495100177!3d12.985436990801919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1666145e01b7%3A0x10032f1f491acb53!2sedynamics+(R.O.+Bangalore)!5e0!3m2!1sen!2sin!4v1512013483592" width="500" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>
            </div>
        </div>
    </div>

    <div class="parallax"><img src="/frontend/Edynamics/img/b2.jpg" alt="Unsplashed background img 1"></div>

</section>
<div class="footertopred"> </div>
@endsection()