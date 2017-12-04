@extends('layouts/frontend/Edynamics/main')
@section('content')
<section>
    <div id="index-banner" class="parallax-container parallax-cont-skew ">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="pagename">
                    <h2 class="header center teal-text text-lighten-2">Careers</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="/frontend/Edynamics/img/about-us-banner.jpg" alt="Unsplashed background img 1"></div>
        <div class="skewed-bg-inn">
            <div class="content container">
                <div>Home - Careers</div>
            </div>
        </div>
    </div>
</section>
<section class="iconic">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb50px">
                <div class="divider-new mb0 pt-5" >
                    <h2 class="h2-responsive  blue-text wow fadeIn ">Current Openings</h2>
                </div>
                <p class="text-center  red-head">YOUR BEST FUTURE</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($carrier as $career) { ?>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="panel panel-default post-panel wow fadeInUp" data-wow-delay="0.2s">
                        <div class="panel-heading">
                            <div class="red-head"><b><?php echo $career->job_title; ?></b></div>
                        </div>
                        <div  class="post-date bg-blue">Job Posting Date:<small><b><?php echo $career->created_date; ?></b></small></div>
                        <div class="panel-body">
                            <div class="row m0">
                                <div class="col-lg-12 col-md-12 col-sm-12 pr0 col-xs-12">
                                    <p class=""><b>Location:</b> <?php echo $career->job_locations; ?></p>
                                    <p class=""><b> Eligibility criteria:</b><?php echo $career->job_eligibility; ?></p>
                                    <p class=""><b> Responsibilities:</b> <?php echo $career->job_responsibilities; ?></p>
                                    <p><b>Application Closed by:</b><?php echo $career->application_close_date; ?></p>
                                </div>
                            </div>
                        </div>
                        <div	 class=" text-center p0  panel-footer"><button  ng-click="openModal(<?php echo $career->id; ?>)"  class="btn apply btn-default" >Apply</button></div>
                    </div>
                </div>
            <?php } ?>
        </div>
</section>



<div class="modal fade" id="login-box">
    <div class="modal-dialog cascading-modal" role="document"> 
        <!--Content-->
        <div class="modal-content"> 

            <!--Header-->
            <div class="modal-header  bg-red white-text">
                <div class="title"><span class="font-bold font-16">Apply  Now</span> <span> <a class="waves-effect white-text pull-right waves-light" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times"><i></i></i></a> </span></div>
            </div>
            <!--Body-->
            <div class="modal-body mb-0">
                <form name="careerForm" novalidate ng-submit="careerForm.$valid && doApplicantAction(career, career.resumeFile)" enctype="multipart/form-data">
                    <input type="hidden" name="career_id" id='career_id' ng-model="career.career_id">
                    <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
                        <input type="text" id="form19" name="first_name" ng-model="career.first_name" class="form-control" required>
                        <label for="form19">First name</label>
                        <div ng-show="sbtBtn" ng-messages="careerForm.first_name.$error">
                            <span ng-show="careerForm.first_name.$error.required" ng-message="required" class="sp-error">First name is required</span>
                        </div>
                    </div>
                    <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
                        <input type="text" id="last_name" name="last_name" ng-model="career.last_name" class="form-control" required>
                        <label for="last_name">Last name</label>
                        <div ng-show="sbtBtn" ng-messages="careerForm.last_name.$error">
                            <span ng-show="careerForm.last_name.$error.required" ng-message="required" class="sp-error">Last name is required</span>
                        </div>
                    </div>
                    <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
                        <input type="text" id="form20" name="email_id"  ng-model="career.email_id"  class="form-control" required>
                        <label for="form20">Email Id</label>
                        <div ng-show="sbtBtn" ng-messages="careerForm.email_id.$error">
                            <span ng-show="careerForm.email_id.$error.required" ng-message="required" class="sp-error">Last name is required</span>
                        </div>
                    </div>
                    <div class="md-form form-sm"> <i class="fa fa-mobile prefix"></i>
                        <input type="text" id="form20" name="mobile_number"  ng-model="career.mobile_number"  class="form-control" required>
                        <label for="form20">Contact Number</label>
                        <div ng-show="sbtBtn" ng-messages="careerForm.mobile_number.$error">
                            <span ng-show="careerForm.mobile_number.$error.required"  ng-message="required" class="sp-error">Mobile number is required</span>
                        </div>
                    </div>
                    <!---->
                    <div class="form-group md-form">
                        <input type="file" ngf-select name="resumeFile" id="resumeFile" ng-model-options="{ allowInvalid: true, debounce: 300 }"  ng-model="career.resumeFile" class="form-control" ngf-model-invalid="errorFile" required>
                        <!--<input type="file"  file-upload  id="resumeFile"  name="resumeFile" ng-model="resumeFile"    >-->
<!--                        <div class="input-group col-xs-12 browse"> <span class="input-group-btn">
                                <button class="input-sm btn btn-info ht40 m0 waves-effect waves-light" type="button"><i class="fa  fa-upload"></i> Resume</button>
                            </span>
                            <input type="text" name="resume"   class="form-control input-sm no_border" disabled placeholder="No file Selected" >
                        </div>-->
<!--                        <div ng-show="sbtBtn" >
                            <span ng-if="!careerForm.resumeFile.$valid" class="sp-error">Resume is required</span>
                        </div>-->
                    </div>
                    <div class="text-center mt-1-half">
                        <button class="btn btn-default mb-2" ng-click="sbtBtn = true">Apply <i class="fa fa-send ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection() 
