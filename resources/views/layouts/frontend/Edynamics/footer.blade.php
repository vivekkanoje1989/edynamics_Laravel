
<footer class="light-blue pt-5  footer-skw  center-on-small-only" > 
  <!--Footer Links-->
  <div class="container">
  
  <div class="row">
                <div class="col-md-5 mt20 col-sm-5 col-xs-12">
                
                    <div class="row">
                       <div class="col-md-12 col-xs-12" align="center">
                        <a href="http://google.com/a/partnersearch/#partner?partner_id=1446409183_a0n60000003lTOpAAM&amp;partner_name=edynamics" target="_blank">
                            <img src="/frontend/Edynamics/img/large-google-w-logo.png" alt="google partner" class="img-responsive google-part">
                        </a> 
                    </div> 
                  </div>  
                </div>

                <div class="col-md-5 mt20  col-sm-3 col-xs-12" align="center">
                    <div class="footer_mid ">
  <ul class="inline-ul ">
          <li><a class="btn-floating  btn-fb waves-effect waves-light"><i class="fa fa-facebook" data-placement="bottom" target="_blank" title="Facebook" href="https://www.facebook.com/edynamicsindia"> </i></a></li>
          <li><a class="btn-floating  btn-tw waves-effect waves-light" data-placement="bottom" target="_blank" title="Twitter" href="https://twitter.com/edynamicsindia"><i class="fa fa-twitter"> </i></a></li>
           <li><a class="btn-floating  btn-gplus waves-effect waves-light" data-placement="bottom" target="_blank" title="Google Plus" href="https://plus.google.com/u/0/b/107224839941253675182/+edynamicsPune"><i class="fa fa-google-plus"> </i></a></li>
        </ul>
                                                <ul class="social-list hide">
                                                            <li>
                                    <a class="facebook itl-tooltip" data-placement="bottom" target="_blank" title="Facebook" href="https://www.facebook.com/edynamicsindia"><i class="fa fa-facebook"></i></a>
                                </li>
                                 
                                <li>
                                    <a class="twitter itl-tooltip" data-placement="bottom" target="_blank" title="Twitter" href="https://twitter.com/edynamicsindia"><i class="fa fa-twitter"></i></a>
                                </li>
                                      
                                <li>
                                    <a class="google itl-tooltip" data-placement="bottom" target="_blank" title="Google Plus" href="https://plus.google.com/u/0/b/107224839941253675182/+edynamicsPune">
                                    <i class="fa fa-google-plus"></i></a>
                                </li>
                                      

                        </ul>

                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12 mob-div" align="center">
                    <a href="http://nextedgegroup.co.in/" target="_blank">
                        <img src="http://edynamics.co.in/themes/edynamics/images/next-edge-logo.png" alt="next-edge-logo" class="img-responsive foot-img" width="auto">
                    </a>
                    <p class="foot-p" style="
    margin: 0;
"> </p>

                </div>
                   
            </div>
  
            
            
          
    
  </div>
  	
 </footer>
  
  <div class="footer-copyright text-right">
    <div class="container-fluid white-text">
      <a href="http://edynamics.co.in/" target="new" class="logo"> 
                   
                       <img  class="edynamic-logo" src="/frontend/Edynamics/img/footer-white-logo-eD.png" width="26">            All Rights Reserved © 2017				
                          
                                <span> edynamics</span>&nbsp;/&nbsp;  </a>
                                
                                
                                <a style="color: #fff;" href="/index.php/site/privacy">Privacy Policy</a>
                       </div>
  </div>
  
  </section>
  

<script src="/frontend/Edynamics/js/bootstrap.min.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/jquery.easing.1.3.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/classie.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/count-to.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/jquery.appear.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/owl.carousel.min.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/jquery.fitvids.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/mdb.js"  type="text/javascript"></script> 
<script src="/frontend/Edynamics/js/script.js" type="text/javascript"></script> 

<script type="text/javascript">
   new WOW().init();
</script> 
 <div id="recentItem"  class="request-demo"><img src="/frontend/Edynamics/img/request-demo.png" alt="request demo"></div>
        <div class="recentItem  bg-gray"> <a  class="cf closX"><i class="fa fa-times floatR"></i> </a>
            <div class="box-innery">
                <h4 class="demo-enquiry-h1">Request Demo</h4>
                <div class="mt-mb35">
                    <div class=" partner-form " ng->
                        <form name="requestDemo" novalidate ng-submit="requestDemo.$valid && requestDemos(request)" >
                            <div class="md-form"> <i class="fa fa-user prefix"></i>
                                <input type="text" name="fname" ng-model="request.fname" id="fname" required  class="form-control">
                                <label for="name" class="">Your name</label>
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.fname.$error">
                                    <span ng-show="requestDemo.fname.$error.required" ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="md-form"> <i class="fa  fa-building prefix"></i>
                                <input type="text" name="company_name" ng-model="request.company_name" required class="form-control">
                                <label for="company_name" class="">Company</label>
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.company_name.$error">
                                    <span  ng-show="requestDemo.company_name.$error.required"  ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="md-form"> <i class="fa fa-envelope prefix"></i>
                                <input type="email" ng-model="request.email_id" name="email_id" required class="form-control validate">
                                <label for="email"  class="">Your email</label>
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.email_id.$error">
                                    <span  ng-show="requestDemo.email_id.$error.required"  ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="md-form"> <i class="fa fa-mobile-phone prefix"></i>
                                <input type="number" name="mobile_number" ng-model="request.mobile_number" required maxlength="10" class="form-control validate">
                                <label for="mobile-no" data-error="wrong" class="">Your Mobile Number</label>
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.mobile_number.$error">
                                    <span ng-show="requestDemo.mobile_number.$error.required" ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="md-form sform-select">
                                <select class="browser-default form-control" name="request_client" ng-model="request.request_client" required>
                                    <option value="" disabled selected>You are</option>
                                    <option value="Builders & Developers">Builders & Developers</option>
                                    <option value="Property Consultants">Property Consultants</option>
                                </select>
                                <i class="fa fa-angle-double-down prefix"></i> 
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.request_client.$error">
                                    <span ng-show="requestDemo.request_client.$error.required" ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="md-form"> <i class="fa fa-map-marker prefix"></i>
                                <input type="text" name="request_city" ng-model="request.request_city" id="request_city" class="form-control" required>
                                <label for="location" class="">Your Location</label>
                                <div ng-show="sbtBtn1" ng-messages="requestDemo.request_city.$error">
                                    <span ng-show="requestDemo.request_city.$error.required" ng-message="required" class="sp-error">This field is required</span>
                                </div>
                            </div>
                            <div class="alert alert-success" ng-if="requestMssg">
                                <strong>Thank you for request</strong>
                            </div>
                            <div class="text-xs-center text-center">
                                <button type="submit" class="btn btn-default mb-2 waves-effect waves-light" ng-disabled="requestBtn" ng-click="sbtBtn1 = true">Send <i class="fa fa-send ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 
 
 
 
 <script>
 </script>
</body>
</html>
