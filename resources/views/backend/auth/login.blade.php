
<link rel="stylesheet" href="/backend/assets/css/w3.css">

<style>
            
                
            @import url('https://fonts.googleapis.com/css?family=Josefin+Sans|Roboto');
            
            body{
                background:#151a22;
            }
           
            .in-tag:focus{
                border-bottom: 2px solid #d52d3a;
                outline: 0 none !important;
                box-shadow: none;
            }
            .in-tag{
                border-bottom: 1px solid #bdefe0 !important;
                color: white !important; /* #bdefe0 */
                border-radius: 0px !important;
                height: 40px !important;
                background: transparent !important;
                border-top: none !important;
                border-left: none !important;
                border-right: none !important;
                box-shadow: none !important;
                font-size: 15px !important;
            }
            
            
            .in-tag::-webkit-input-placeholder { /* Chrome/Opera/Safari */
                  color: #bdefe0 !important;
            }
            .in-tag::-moz-placeholder { /* Firefox 19+ */
                  color: #bdefe0 !important;
            }
            .in-tag:-ms-input-placeholder { /* IE 10+ */
                  color: #bdefe0 !important;
            }
            .in-tag:-moz-placeholder { /* Firefox 18- */
                  color: #bdefe0 !important;
            }           
            .in-tag::-webkit-input-placeholder { /* Chrome/Opera/Safari */
              color: #000;
            }
            .in-tag::-moz-placeholder { /* Firefox 19+ */
              color: #000;
            }
            .in-tag:-ms-input-placeholder { /* IE 10+ */
              color: #000;
            }
            .in-tag:-moz-placeholder { /* Firefox 18- */
              color: #000;
            }

            .input-group{
                margin-bottom: 5px;
                width: 100%;

            }
            .w3-btn-floating-large {
                top: -47px !important;
                right: 16px !important;
                line-height: 0 !important;
                height: 90px !important;
                width: 90px !important;
            }
            .w3-btn{
                background: #fff;
                margin-bottom: 15px;
                width: 115px;
                height: 40px;
                font-size: 15px;
                border: none;
                color: #00a876;
                font-weight: 600;
            }
            .w3-btn:hover{
                background:rgba(65, 65, 65, 0.68) !important;
                color:#fff !important;
                box-shadow:none;
               
            }

            .foot-div2{
                font-size: 13px;
                background: transparent;
                padding: 15px;
                border: none;
                margin-top: 3px;

            } 
           
            .half-1{
                height:100vh;
                background: rgba(0, 168, 118, 0.19);
            }
            .half-2{
                height: 100%;
                
            }   
            .usr-img-div{
                position:relative;
                margin-bottom: 15px;
                margin-bottom:1px !important;
            } 
            .usr-img{
                margin-bottom: 10px;
                margin-top: 10px;
                width: 60px;
                height: 60px;
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)!important;
                border-radius: 50%;
            }

            .input-group-addon{ 
                border-radius: 0px !important;
                background: transparent !important;
                border-bottom:1px solid #bdefe0 !important;
                border-left: none !important;
                border-top: none !important;
                color:#bdefe0 !important;
            }       
        
        </style>
        
<div class="page-bg" ng-controller="adminController" style="background:url(/backend/images/bg.jpg);background-repeat: no-repeat;background-size: cover;min-height: 100%;    position: absolute;    width: 100%;">
    <div class="sub-page-bg">
        <div class="col-md-7 col-lg-8 col-xs-12 half-2" align="center"> 
            <div class="">
                <div class="row img-div">
                    <h1 class="v2">
                        Getting ready to glide on </h1>
                    <img src="backend/images/loading.gif" class="loding-img">
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-4 col-xs-12 half-1 mob-bg" align="center">
            <div class="left-div">
                <div class="col-md-12 col-xs-12 bg1" style="margin-bottom: 40px;">
                    <form name="loginForm" novalidate ng-submit="loginForm.$valid && login(loginData)" >
                        <input type="hidden" ng-model="loginData.csrfToken" name="csrftoken" id="csrftoken" ng-init="loginData.csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">

                        <div class="col-xs-12 col-md-12">
                            <div class="usr-img-div">
                                <img class="usr-img" ng-if="!user_profile" src="/backend/images/user-1.png" class="log-usr ng-scope">
                                <img class="usr-img" ng-if="user_profile" ng-src="[[ Config('global.s3Path') ]]/employee-photos/{{user_profile}}" class="log-usr ng-scope">
                            </div>                         

                            <p class="usr-name ng-scope" ng-if="!fullName">Hello, GUEST</p>
                            <p class="usr-name ng-scope" ng-if="fullName">Hello, {{fullName}}</p>

                        </div>
                        <div id="login-form" class="w3-animate-right col-xs-12 col-md-12" >
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                                <input type="text" name="mobile" class="form-control in-tag ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" placeholder="Mobile" ng-model="loginData.mobile" check-login-credentials="" minlength="10" maxlength="10" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" ng-model-options="{allowInvalid: true, debounce: 100}" >
                            </div>                            
                            <div ng-show="next1" ng-messages="loginForm.mobile.$error" class="help-block next1">
                                <div ng-message="required" class="sp-err">Username is required</div>
                                <div ng-message="minlength"  class="sp-err">Invalid mobile no.</div>
                                <div ng-message="wrongCredentials"  class="sp-err">{{errMsg}}</div>
                            </div>                             
                            <br>
                            <br>
                            <div class="group-div" align="center">
                                <button class=" w3-btn w3-hover-white bt-next1" ng-click="next1 = true">Next</button>
                            </div>
                        </div>
                        <div id="forgot-form" class="w3-animate-right col-xs-12 col-md-12">                            
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input class="form-control in-tag ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" placeholder="Password" type="password" name="password" minlength="6" maxlength="15" ng-model="loginData.password" required="" ng-model-options="{allowInvalid: true, debounce: 100}" >
                            </div>                            
                            <div ng-show="next2" ng-messages="loginForm.password.$error" class="help-block next2">
                                <div ng-message="required"  class="sp-err">Required</div>
                                <div ng-message="minlength"  class="sp-err">Too short (Minimum length is 6 characters)</div>
                                <div ng-message="maxlength"  class="sp-err">Too long (Maximum length is 15 characters)</div>
                                <div ng-message="wrongCredentials" class="sp-err">Wrong password!</div>                                
                            </div>
                            <div class="mar10">
                                <a href="javascript:void(0);" ng-model="collapsed" ng-click="collapsed = !collapsed" style="color: white;">Forgot Password?</a>
                                <div ng-show="collapsed">
                                    <h5 style="color: white;">You really forgot your password ?</h5>                                     
                                    <div>
                                        <button ng-show="collapsed" ng-click="collapsed = !collapsed" class="for-btn">Yes</button>
                                        <button ng-show="collapsed" ng-click="collapsed = !collapsed" class="for-btn">No</button>
                                    </div>   
                                </div>
                            </div>
                            <br>
                            <div class="group-div"  align="center">
                                <button type="submit" ng-click="next2 = true" class="sub-btn w3-btn">Login</button>
                            </div>

                            <div class="sp-err" ng-if="sspMsg" >{{sspMsg}}</div>
                        </div> 
                        </form>                      
                    </div>                       
                <div class="left-logo-div">
                    <p style=" margin-top: 25px;color:white;"><a href="http://edynamics.co.in/" target="_blank" class="footer-a">
                            All Rights Reserved © 2017 edynamics Business Services LLP </a></p>
                    <img src="http://bmsbuilder.in/themes/backend/bms.1.9.14/bms.png" class="bms-logo">     
                    <img src="http://bmsbuilderdev.in/common/images/edynamicslogo.jpg" class="bms-logo">        
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".bt-next1").click(function (e) {
            if ($(".next1").hasClass("ng-active")) {
                e.preventDefault();
            } else {
                $("#login-form").hide();
                $("#forgot-form").show();
            }
        });
        $(".next2").click(function (e) {
            if ($(".next2").hasClass("ng-active")) {
                e.preventDefault();
            } else {
                $("#forgot-form").hide();
                $("#otp-form").show();
            }
        });
    });
</script>