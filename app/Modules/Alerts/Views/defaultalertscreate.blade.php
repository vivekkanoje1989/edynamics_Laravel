<style>
    .bordered-bot {
        border-color: #2dc3e8 !important;
    }
</style>

<div class="row">
    <div class="widget flat radius-bordered ">
        <div class="col-lg-12 col-sm-12 col-xs-12" ng-controller="defaultalertsController">
            <h5 class="row-title before-themeprimary"><i class="fa  fa-arrow-circle-o-right themeprimary"></i>{{pageHeading}}</h5>
            <div class="widget-body bordered-top bordered-sky col-lg-12 col-sm-12 col-xs-12">
                <div id="customer-form">
                    <form novalidate role="form" ng-submit="defaultAlertForm.$valid &&  createAlert(defaultAlertData,[[ !empty($alertId) ?  $alertId : '0' ]])" name="defaultAlertForm" ng-init="manageDafaultAlerts([[ !empty($alertId) ?  $alertId : '0' ]],'edit')">
                        <input type="hidden" ng-model="defaultAlertData.csrfToken" name="csrftoken" id="csrftoken" ng-init="defaultAlertData.csrfToken = '[[ csrf_token() ]]'" class="form-control">
                        <input type="hidden" ng-model="defaultAlertData.client_id" name="client_id">
                        <div class="row col-lg-12 col-sm-12 col-xs-12">  
                            <hr class="wide" />
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-title">
                                    Update Default Alerts
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="well with-header  with-footer col-md-12 col-xs-12 mar-bot30">
                                    <div class="header bordered-bot"> 
                                        <center> 
                                            <b>
                                                Default Alerts
                                            </b> 
                                        </center>
                                    </div>
                                    <div class="buttons-preview">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 nopadleft">
                                                    <label for="definpu">Alert Name :</label>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 nopadright">
                                                    <div class="form-group field-alertscustommodel-event_id required">
                                                        <span class="input-icon icon-right">
                                                            <select ng-model="defaultAlertData.templates_event_id" ng-init="getTemplatesEvents()" name="templates_event_id" class="form-control" required >
                                                                <option value="">Select Event</option>
                                                                <option ng-repeat="t in templateEvents track by $index" value="{{t.id}}" ng-selected="{{ t.id == defaultAlertData.templates_event_id}}">{{t.event_name}}</option>
                                                            </select>
                                                            <i class="fa fa-sort-desc"></i>
                                                            <div ng-show="sbtBtn && defaultAlertForm.templates_event_id.$invalid " ng-messages="defaultAlertForm.templates_event_id.$error" class="help-block">
                                                                <div ng-message="required" style="color: red !important;">This field is required</div>
                                                            </div> 
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 nopadleft">
                                                    <label for="definpu">Alert For :</label>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 nopadright">
                                                    <div class="form-group field-alertscustommodel-event_id required">
                                                        <span class="input-icon icon-right">
                                                            <select ng-model="defaultAlertData.template_for" name="template_for" class="form-control" required >
                                                                <option value="">Select For</option>
                                                                <option value="0">Employee</option>
                                                                <option value="1">Customer</option>
                                                            </select>
                                                            <i class="fa fa-sort-desc"></i>
                                                            <div ng-show="sbtBtn && defaultAlertForm.template_for.$invalid " ng-messages="defaultAlertForm.template_for.$error" class="help-block">
                                                                <div ng-message="required" style="color: red !important;">This field is required</div>
                                                            </div> 
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 nopadleft">
                                                    <label for="definpu">SMS Body :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 nopadright">
                                                    <div class="form-group field-alertscustommodel-sms_body required">
                                                        <span class="input-icon icon-right">
                                                            <textarea ck-editor ng-model="defaultAlertData.sms_body" name="sms_body" class="form-control ng-pristine ng-valid ng-valid-required ng-touched" required=""></textarea>
                                                            <i class="fa fa fa-align-left"></i>
                                                            <div ng-show="sbtBtn &amp;&amp; defaultAlertForm.sms_body.$invalid " ng-messages="defaultAlertForm.sms_body.$error" class="help-block ng-hide ng-inactive">
                                                            <div ng-message="required" style="color: red !important;">This field is required</div>
                                                            </div>
                                                        </span>
                                                    </div>                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 nopadleft">
                                                    <label for="definpu">Email Subject :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 nopadright">
                                                    <div class="form-group field-alertscustommodel-email_subject required">
                                                       <span class="input-icon icon-right">
                                                            <textarea ck-editor ng-model="defaultAlertData.email_subject" name="email_subject" class="form-control ng-pristine ng-valid ng-valid-required ng-touched" required=""></textarea>
                                                            <i class="fa fa fa-align-left"></i>
                                                            <div ng-show="sbtBtn &amp;&amp; defaultAlertForm.email_subject.$invalid " ng-messages="defaultAlertForm.email_subject.$error" class="help-block ng-hide ng-inactive">
                                                            <div ng-message="required" style="color: red !important;">This field is required</div>
                                                            </div>
                                                        </span>
                                                    </div>                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 nopadleft">
                                                    <label for="definpu">Email Body :</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 nopadright">
                                                    <div class="form-group field-alertscustommodel-email_body required">
                                                       <span class="input-icon icon-right">
                                                            <textarea ck-editor ng-model="defaultAlertData.email_body" name="email_body" class="form-control ng-pristine ng-valid ng-valid-required ng-touched" required=""></textarea>
                                                            <i class="fa fa fa-align-left"></i>
                                                            <div ng-show="sbtBtn &amp;&amp; defaultAlertForm.email_body.$invalid " ng-messages="defaultAlertForm.email_body.$error" class="help-block ng-hide ng-inactive">
                                                            <div ng-message="required" style="color: red !important;">This field is required</div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <center>
                                                    <div class="form-group">
                                                         <button type="submit" class="btn btn-primary" ng-click="sbtBtn=true">{{buttonLabel}}</button>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="well with-header  with-footer col-md-12 col-xs-12 mar-bot30">
                                    <div class="header bordered-bot"> 
                                        <center> 
                                            <b>
                                                Custom AlertsReplaceable tags to be used in SMS / email templates
                                            </b> 
                                        </center>
                                    </div>
                                    <div class="buttons-preview">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for="definpu"><b>Customer related tags :</b></label>
                                                <p> 1) Customer Full Name : [#custName#]</p>
                                                <p> 2) Customer Mobile : [#custMobile#]</p>
                                                <p> 3) Customer Email ID : [#custEmail#]</p>
                                                <p> 4) Title : [#title#]</p>
                                                <p> 5) Greeting : [#greeting#]</p>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for="definpu"><b>Employee related tags :</b></label>
                                                <p> 1) Employee Full Name : [#employeeName#]</p>
                                                <p> 2) Employee Mobile : [#employeeMobile#]</p>
                                                <p> 3) Employee Email ID : [#employeeEmail#]</p>
                                                <p>4) Employee Designation: [#employeeDesignation#]</p>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for="definpu"><b>Company related tags :</b></label>
                                                <p> 1) Company Name : [#companyMktName#]</p>
                                                <p> 2) Company Address : [#companyAddress#]</p>
                                                <p> 3) Company Contact Number : [#companyNumber#]</p>
                                                <p>4) Company Email ID : [#companyEmail#]</p>
                                                <p>5) Company Logo : [#companyLogo#]</p>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for="definpu"><b>Vehicle related tags :</b></label>
                                                <p>  1) Vehicle Brand : [#brandName#]</p>
                                                <p>  2) Vehicle Model : [#modelName#]</p>
                                                <p>  3) Appointment Date : [#appointmentDate#]</p>
                                                <p>  4) Appointment Time : [#appointmentTime#]</p>
                                                <p>  5) Customer Information Form Link: [#custFormLink#] </p>
                                                <p><b>  Example:</b></p>
                                                <xmp><a href="[#custFormLink#]">Click Here</a></xmp>
                                                <p>   6) Google Map Link (ifram): [#showroomGoogleMap#] </p>
                                            </div>
                                        </div>

                                        <hr style="margin-bottom: 20px" class="col-md-12 col-xs-12">
                                        <div class="col-md-12 col-xs-12">
                                            <h4 class="col-lg-12 col-xs-12">Example : </h4>

                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for=""><b>Raw Message :</b></label>
                                                <p>
                                                    Dear <b>[#custName#]</b>,<br>
                                                    Thank you for enquiring with us Our team member<b> [#employeeName#]</b> will get back to you soon.<br>
                                                    regards,<br>
                                                    <b>[#companyMktName#]</b>
                                                </p>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label for=""><b>Your SMS / email look like below :</b></label>
                                                <p>
                                                    Dear <b>Mandar Hendre</b>,<br>
                                                    Thank you for enquiring with us Our team member <b>Rohit Kedar</b> will get back to you soon.<br>
                                                    regards,<br>
                                                    <b>LMS Auto</b>
                                                </p>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
