@extends('layouts/frontend/Edynamics/main')
@section('content') 
  <div id="index-banner" class="parallax-container parallax-cont-skew ">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="pagename">
          <h2 class="header center teal-text text-lighten-2">Partnership </h2>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="/frontend/Edynamics/img/about-us-banner.jpg" alt="Unsplashed background img 1"></div>
    <div class="skewed-bg-inn">
      <div class="content container">
        <div>Home - Partnership</div>
      </div>
    </div>
  </div>
</section>
<section class="iconic">
  <div class="container">
  
   <div class="row ">
    <div class="col-md-12">
      <div class="divider-new pt-5" >
        <h2 class="h2-responsive  blue-text wow fadeIn">Work With Us</h2>
      </div>
    </div>

      </div>
      <div class="row">

      
      <div class="col-lg-12 col-md-12">
      <p>There has been a subtle change in the concept and practices of running a business. Today, everything from buying food to buying railway ticket is going online. edynamics is a Google partner company who has developed an idea of controlling businesses using the platform called BMS. If you have skills and passion for achieving new goals in IT Products, their sales and services. If you are one of those in millions, you are welcome to join the simplifying business journey with us.</p>
      </div>
   
      </div>
      <div class="row">
         <div class="col-md-6  mt-mb35  col-lg-6 col-xs-12">
<p class="red-head">Franchise opportunities are offered for the following States :</p>
<div class="row">
<div class="col-lg-6 col-sm-6 col-xs-12"><ul class="product-points">
<li>Andhra Pradesh</li>

<li>Uttar Pradesh</li>

<li>Bihar</li>

<li>Madhya Pradesh</li>

<li>Chhattisgarh</li>

<li>Delhi</li>

<li>Gujarat</li>

<li>Himachal Pradesh</li>

<li>Uttaranchal</li>
<li>Jammu and Kashmir</li>
</ul></div>
<div class="col-lg-6 col-sm-6 col-xs-12"><ul class="product-points">



<li>Karnataka</li>

<li>Punjab</li>

<li>Haryana</li>

<li>Rajasthan</li>

<li>Tamil Nadu</li>

<li>Kerala</li>

<li>West Bengal</li>

<li>Uttarakhand</li>

<li>Jharkhand</li>
</ul></div>
</div>


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
                            <label for="email"  >Your email *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.email_id.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-mobile-phone prefix"></i>
                            <input type="number" id="mobile_number" ng-model="contact.mobile_number" class="form-control validate" maxlength="10" required>
                            <label for="mobile-no"  >Your Mobile Number *</label>
                            <div ng-if="sbtBtn" ng-messages="contactUs.mobile_number.$error">
                                <span ng-message="required" class="sp-error">This field is required</span>
                            </div>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-pencil prefix"></i>
                            <textarea type="text" id="message" ng-model="contact.message" class="md-textarea" required></textarea>
                            <label for="message">Message *</label>
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
  
  </div>
</section>

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
<div class="footertopred"> </div>
@endsection()