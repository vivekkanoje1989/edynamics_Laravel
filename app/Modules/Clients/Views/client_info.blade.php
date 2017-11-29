<style>
    .actions {
        z-index: 0 !important;
    }
    .help-block {
        margin-top: 0px !important; 
        margin-bottom: 0px !important; 
        color: #e46f61;
    }
    .toggleClassActive {font-size:28px !important;cursor:pointer;color: #5cb85c !important;vertical-align: middle;margin-left: 15px;}
    .toggleClassInactive {font-size:28px !important;cursor:pointer;color: #d9534f !important;vertical-align: middle;margin-left: 15px;}
</style>

<div ng-controller="clientInfoCtrl">
    <form ng-submit="frmcrtClients.$valid && createClients(clientData)"  name="frmcrtClients"  novalidate enctype="multipart/form-data" ng-init="manageClientinfowithservices(<?php echo $clientId; ?>)" >
        <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
        <?php
        if (empty($clientId))
            $clientId = 0;
        ?>           

        <div style="display:none">{{clientData.id = <?php echo $clientId; ?>}}</div> 
        <input type="hidden" ng-model="clientData.id"  name="id">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <h5 class="row-title before-themeprimary"><i class="fa  fa-arrow-circle-o-right themeprimary"></i>{{ clientData.legal_name}}</h5>
                <div class="step-content" id="WiredWizardsteps">
<!--                    <div class="step-pane active" id="wiredstep1" ng-controller="CountryListCtrl">
                        <div class="form-title">Client Information</div>
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Client Groups <span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="clientData.group_id" ng-controller="getClientGroupsCtrl" name="group_id" class="form-control" required="required">
                                            <option value="">Select Client Groups</option>
                                            <option ng-repeat="clientGrpObj in clientGroupsList" value="{{clientGrpObj.id}}" ng-selected="{{ clientGrpObj.id == clientData.group_id}}">{{clientGrpObj.group_name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.group_id.$error">
                                            <div ng-message="required" class="sp-err" >Client Groups cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Marketing Name <span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="25" maxlength="25"  oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')" ng-model="clientData.marketing_name" name="marketing_name" required>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.marketing_name.$error">
                                            <div ng-message="required" class="sp-err" >Marketing Name cannot be blank.</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 25 Characters Allowed</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Legal Name<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="25" maxlength="25" oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')"  ng-model="clientData.legal_name" name="legal_name" required>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.legal_name.$error">
                                            <div ng-message="required" class="sp-err" >Legal Name cannot be blank.</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 25 Characters Allowed</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group" ng-controller="getCompanyTypeCtrl">
                                    <label for="">Company<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="clientData.type_of_company" name="type_of_company" class="form-control" required>
                                            <option value="">Select Company</option>
                                            <option ng-repeat="companyTypeObj in companyTypeList" value="{{companyTypeObj.id}}" ng-selected="{{ companyTypeObj.id == clientData.type_of_company}}">{{companyTypeObj.type_of_company}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.type_of_company.$error">
                                            <div ng-message="required" class="sp-err" >Company cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Address<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <textarea ng-model="clientData.office_address" name="office_address" ng-maxlength="200"    class="form-control" required></textarea>
                                        <div class="help-block step1" ng-show="btnClientInfo"  ng-messages="frmcrtClients.office_address.$error ">
                                            <div ng-message="required" class="sp-err" >Office address cannot be blank.</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 200 Characters Allowed</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Pin Code<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-model="clientData.pin_code" ng-minlength="6" ng-maxlength="6" minlength="6"  maxlength="6" name="pin_code" ng-pattern="/[0-9]/" required>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.pin_code.$error">
                                            <div ng-message="required" class="sp-err" >Pin code cannot be blank.</div>
                                            <div ng-message="minlength" class="sp-err">Too short (Minimum length is 6 digit)</div>
                                            <div ng-message="maxlength" class="sp-err">Too short (Maximum length is 6 digit)</div>
                                            <div ng-message="pattern" class="sp-err" >Only numeric value Allowed</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">Country<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="clientData.country_id" ng-change="onCountryChange()" id="country_id"  name="country_id" class="form-control" required="required">
                                            <option value="">Select Country</option>
                                            <option ng-repeat="countryObj in countryList" value="{{countryObj.id}}" ng-selected="{{ countryObj.id == clientData.country_id}}">{{countryObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.country_id.$error">
                                            <div ng-message="required" class="sp-err" >Country cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">State<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="clientData.state_id"  ng-change="onStateChange()" name="state_id" id="state_id" class="form-control" required>
                                            <option value="">Select State</option>
                                            <option ng-repeat="stateObj in stateList" value="{{stateObj.id}}" ng-selected="{{ state_id == stateObj.id}}">{{stateObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.state_id.$error">
                                            <div ng-message="required" class="sp-err" >State cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>    
                        <div class="row">    
                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">City<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="clientData.city_id"  name="city_id" class="form-control" required>
                                            <option value="">Select City</option>
                                                <option ng-repeat="cityObj in cityList" value="{{cityObj.id}}" ng-selected="{{ cityObj.id == clientData.city_id}}">{{cityObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.city_id.$error">
                                            <div ng-message="required" class="sp-err" >City cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div> 


                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">Company Logo<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="file" ngf-select name="company_logo"   ng-model="clientData.company_logo" name="company_logo" id="company_logo" accept="image/*" ngf-max-size="2MB" class="form-control imageFile"  ngf-model-invalid="errorFile" ng-required='{{reqnone}}'>
                                        <div class="help-block step1" ng-show="btnClientInfo"  ng-if="companyLogoValidation" ng-messages="frmcrtClients.company_logo.$error">
                                            <div ng-message="required" class="sp-err" >Company Logo cannot be blank.</div>
                                        </div>
                                        <?php
                                        if ($clientId != 0) {
                                            $s3Path = config('global.s3Path');
                                            ?>
                                            <div>
                                                <img  src="<?php echo $s3Path; ?>/client/{{clientData.id}}/{{ clientData.company}}"   class="thumb photoPreview"/>
                                            </div>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div> 

                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">Website URL<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" name="website" ng-model="clientData.website" ng-maxlength="100"  ng-pattern="/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/" required />
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.website.$error">
                                            <div ng-message="required" class="sp-err " >URL cannot be blank.</div>
                                            <div ng-message="pattern" class="sp-err">Enter a valid URL</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 100 Characters Allowed</div>
                                        </div>
                                        <div class="sp-err">Note: URL should be start with http:// or https://</div>
                                    </span>
                                </div>
                            </div> 

                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">Website With<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <div class="control-group">
                                            <div class="radio">
                                                <label>
                                                    <input name="website_with" type="radio" ng-model="clientData.website_with" value="0" class="colored-success" required />
                                                    <span class="text">Website provided by and managed by us</span>
                                                </label> &nbsp;
                                                <label>
                                                    <input name="website_with" type="radio" ng-model="clientData.website_with" value="1" class="colored-danger" required />
                                                    <span class="text"> Website is with another service provider</span>
                                                </label>
                                            </div>
                                            <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.website_with.$error">
                                                <div ng-message="required" class="sp-err " >Website With cannot be blank.</div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div> 

                        </div>    
                        <div class="row">
                            <div class="col-sm-3 col-xs-6" >
                                <div class="form-group">
                                    <label for="">Right Click<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <div class="control-group">
                                            <div class="radio">
                                                <label>
                                                    <input name="right_click" type="radio" ng-model="clientData.right_click" value="1" class="colored-success" required />
                                                    <span class="text">Enable</span>
                                                </label> &nbsp;
                                                <label>
                                                    <input name="right_click" type="radio" ng-model="clientData.right_click" value="0" class="colored-danger" required />
                                                    <span class="text"> Disable</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="help-block step1" ng-show="btnClientInfo" ng-messages="frmcrtClients.right_click.$error">
                                            <div ng-message="required" class="sp-err" >Right Click With cannot be blank.</div>
                                        </div>  
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>       
                    <div class="step-pane active" id="wiredstep1">
                        <div class="form-title ">Contact Information</div>
                        <div class="row">
                            <p style="float: right">
                                <a href="" data-toggle="modal" data-target="#contactInfoModal" ng-click="initialContactModal(0, '', 0, '')" class="btn btn-primary btn-info">Create New Contact</a>&nbsp;&nbsp;&nbsp;
                            </p>

                            <div class="row">
                                <div class="col-md-12 col-xs-12"  align="center">
                                    <div class="col-md-12 col-xs-12"  align="center">
                                        <table class="table table-hover table-striped table-bordered" at-config="config">
                                            <thead class="bord-bot">
                                                <tr>
                                                <tr>
                                                    <th style="width:5%">
                                                        Sr. No.
                                                    </th>                       
                                                    <th style="width: 30%">
                                                        First Name
                                                    </th>  

                                                    <th style="width: 30%">
                                                        Last Name
                                                    </th>

                                                    <th style="width: 5%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" dir-paginate="list in clientContactInfo| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                                                    <td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                                                    <td>{{ list.first_name}}</td>                          
                                                    <td>{{ list.last_name}}</td>                                                                                                                                               
                                                    <td class="fa-div">
                                                        <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#contactInfoModal"><a href="javascript:void(0);" ng-click="initialContactModal({{ list.id}},{{list}},1, $index)"><i class="fa fa-pencil"></i></a></div>
                                                    </td>
                                                </tr>
                                                <tr ng-if='totalrecords == 0'>
                                                    <td colspan='4' align='center'>- No Records Found -</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div> 
                            <br>
                            <p style="float: right">
                                <button type="submit" class="btn btn-primary btn-submit-last" >Submit</button>&nbsp;&nbsp;&nbsp;
                            </p>
                        </div>    
                    </div> -->
                    <div class="step-pane active" id="wiredstep1">
                        <div class="form-title ">Services</div>
                        <div class="row">
                            
                            <p style="float: right">
                                <a href="[[ config('global.backendUrl') ]]#/invoices/index/{{clientData.id}}"  target="_blank"  ng-click="initialServiceModal(0, '', 0, '')" class="btn btn-primary btn-info">View Invoice</a>&nbsp;&nbsp;&nbsp;
                            </p>
                            <p style="float: right">
                                <a href="[[ config('global.backendUrl') ]]#/ctbillsettings/index/{{clientData.id}}"  target="_blank"   class="btn btn-primary btn-info">Manage Cloud Telephony Numbers</a>&nbsp;&nbsp;&nbsp;
                            </p>
                            
                            <p style="float: right">
                                <a href="[[ config('global.backendUrl') ]]#/clients/addservice/{{clientData.id}}/0" target="_blank"  class="btn btn-primary btn-info">Add New Service</a>&nbsp;&nbsp;&nbsp;
                            </p>
                            <p style="float: right">
                                <a href="" data-toggle="modal" data-target="#generateInvoiceModal" ng-if="serviceselected" ng-click="initialGenerateInvoiceModal(servicesID,clientData.id)" class="btn btn-primary btn-info">Generate Invoice</a>&nbsp;&nbsp;&nbsp;
                            </p>
                            <div class="row">
                                <div class="col-md-12 col-xs-12"  align="center">
                                    <div class="col-md-12 col-xs-12"  align="center">
                                        <table class="table table-hover table-striped table-bordered" at-config="config">
                                            <thead class="bord-bot">
                                                <tr>
                                                <tr>
                                                    <th style="width:5%">
                                                        Sr. No.
                                                    </th>                       
                                                    <th style="width: 5%">
                                                        Select
                                                    </th>  
                                                    <th style="width: 30%">
                                                        Service Name
                                                    </th>
                                                     <th style="width: 30%">
                                                        Status
                                                    </th>
                                                    <th style="width: 5%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" dir-paginate="list in clientServices| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                                                    <td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                                                    <td>
                                                        <span ng-init='(list.status == 1)? servicelist[list.id]= 1 : servicelist[list.id]= 0'></span>
                                                         <label>
                                                             <input type="checkbox"  name="servicetype" class="form-control"  ng-click="selectedService(list.service_id)" value="{{ list.id}}">
                                                            <span class="text"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{ list.service_name}}</td>
                                                    <td ng-if="servicelist[list.id] == 1">
                                                        <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" checked="" ng-click="changeServiceStatus(0,$index,list.id);"><span  class="text"></span></label>    
                                                    </td>
                                                    <td ng-if="servicelist[list.id] == 0">
                                                        <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1"  ng-click="changeServiceStatus(1,$index,list.id);"><span  class="text"></span></label>    
                                                    </td>
                                                    <td class="fa-div">
                                                        <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" >
                                                            <a href="#/clients/addservice/{{clientData.id}}/{{list.service_id}}"  ><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr ng-if='clientServices == 0'>
                                                    <td colspan='5' align='center'>- No Records Found -</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div> 
                        </div>

                    </div>
                </div>   
            </div>

        </div>
    </form>

    <div class="modal fade" id="contactInfoModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{contactModalHeading}}</h4>
                </div>

                <form ng-submit="frmCltContactInfo.$valid && processCltContactInfo(cltcontactdata)" name="frmCltContactInfo"  novalidate>
                    <div class="modal-body row">
                        <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>


                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" ng-model="cltcontactdata.id" name="id">
                                        <label>   Person Type<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <div class="radio">
                                                <label>
                                                    <input name="person_type" type="radio" ng-model="cltcontactdata.person_type" value="1" class="colored-success" required />
                                                    <span class="text">Normal User</span>
                                                </label> &nbsp;
                                                <label>
                                                    <input name="person_type" type="radio" ng-model="cltcontactdata.person_type" value="0" class="colored-danger" required />
                                                    <span class="text"> Admin User</span>
                                                </label>
                                            </div>

                                            <div class="help-block" ng-if="clt_contact_display_msg" ng-show="btnAddContact" ng-messages="frmCltContactInfo.person_type.$error">
                                                <div ng-message="required" class="sp-err" >Person Type  cannot be blank.</div>
                                            </div> 

                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="">Title<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="cltcontactdata.title_id" ng-controller="titleCtrl" name="title_id" class="form-control" required="required">
                                                <option value="">Select Title</option>
                                                <option ng-repeat="t in titles track by $index" value="{{t.id}}" ng-selected="{{ t.id == title_id}}">{{t.title}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                            <div ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.title_id.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">Title cannot be blank.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>    
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label>First Name<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" name="first_name" ng-model="cltcontactdata.first_name" ng-maxlength="15" capitalization oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')"  required />
                                            <div class="help-block" ng-if="clt_contact_display_msg" ng-show="btnAddContact" ng-messages="frmCltContactInfo.first_name.$error">
                                                <div ng-message="required" class="sp-err" >First Name cannot be blank.</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 15 Characters Allowed</div>
                                            </div>


                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label>   Last Name<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" name="last_name" ng-model="cltcontactdata.last_name" ng-maxlength="15" capitalization oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')"  required />
                                            <div class="help-block" ng-if="clt_contact_display_msg" ng-show="btnAddContact" ng-messages="frmCltContactInfo.first_name.$error">
                                                <div ng-message="required" class="sp-err" >Last Name cannot be blank.</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 15 Characters Allowed</div>
                                            </div>


                                        </span>
                                    </div>
                                </div>   
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Gender <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="cltcontactdata.gender_id" ng-controller="genderCtrl" name="gender_id" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option ng-repeat="genderList in genders track by $index" value="{{genderList.id}}" ng-selected="{{ genderList.id == gender_id}}">{{genderList.gender}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                            <div ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.gender_id.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">Gender cannot be blank.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label for="">Designation <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="cltcontactdata.designation_id" name="designation_id" ng-controller="designationCtrl" class="form-control" required>
                                                <option value="">Please Designation</option>
                                                <option ng-repeat="list in designationList track by $index" value="{{list.id}}" ng-selected="{{ designation_id == list.id}}">{{list.designation}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                            <div ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.designation_id.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">Designation cannot be blank.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>   
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Mobile <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" ng-maxlength="10" ng-model="cltcontactdata.mobile_number" name="mobile_number" ng-pattern='/([987]{1,1})+([0-9]{9,9})$/' ng-change="validateMobile(cltcontactdata.mobile_number, 'errPersonalMobile');"  required>

                                            <div class="help-block {{ applyClassPMobile}}" ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.mobile_number.$error">
                                                <div ng-message="required" class="sp-err" >Mobile cannot be blank.</div>
                                                <div ng-message="pattern" class="sp-err">Enter a valid mobile number</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 10 Characters Allowed</div>
                                                <div>{{ errPersonalMobile}}</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">email <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="email" class="form-control" ng-maxlength="30" ng-model="cltcontactdata.email_id" name="email_id" maxlength="40"  ng-pattern="/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" required>

                                            <div class="help-block" ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.email_id.$error">
                                                <div ng-message="required" class="sp-err" >email cannot be blank.</div>
                                                <div ng-message="pattern" class="sp-err">Enter a valid email</div>
                                                <div ng-message="email">Invalid email address.</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 30 Characters Allowed</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="col-sm-6" ng-if="isexitsContact == 0">
                                    <div class="form-group">
                                        <label for="">Password <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="password" class="form-control" ng-maxlength="6"  ng-minlength="6" ng-model="cltcontactdata.password" name="password"  required>
                                            <div class="help-block" ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.password.$error">
                                                <div ng-message="required" class="sp-err" >Password cannot be blank.</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 6 Characters Allowed.</div>
                                                <div ng-message="minlength"  class="sp-err" >Minimum 6 Characters Allowed.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-6" ng-if="isexitsContact == 0">
                                    <div class="form-group">
                                        <label>Re Enter Password <span ng-show="isexitsContact == 0" class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="password" ng-model="cltcontactdata.password_confirmation" name="password_confirmation" ng-minlength="6" ng-maxlength="6" class="form-control" compare-to="cltcontactdata.password" required> 
                                            <i class="fa fa-lock"></i>
                                            <div ng-show="btnAddContact" ng-messages="frmCltContactInfo.password_confirmation.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">Re Enter Password cannot be blank.</div>
                                                <div ng-message="compareTo" class="sp-err">Must match password and confirm password.</div>
                                                <div ng-message="minlength" class="sp-err">Minimum 6 Characters Allowed.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">High Security Password Type <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <span class="input-icon icon-right">
                                                <div class="radio">
                                                    <label>
                                                        <input name="high_security_password_type" type="radio" ng-model="cltcontactdata.high_security_password_type" value="1" class="colored-success" required />
                                                        <span class="text">High security password should be user defined fix password</span>
                                                    </label> &nbsp;
                                                    <label>
                                                        <input name="high_security_password_type" type="radio" ng-model="cltcontactdata.high_security_password_type" value="0" class="colored-danger" required />
                                                        <span class="text"> High security password should be OTP every time</span>
                                                    </label>
                                                </div>

                                                <div class="help-block" ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.high_security_password_type.$error">
                                                    <div ng-message="required" class="sp-err" >High Security Password Type cannot be blank.</div>
                                                </div> 

                                            </span>
                                        </span>
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-sm-6" ng-if="cltcontactdata.high_security_password_type == 1">
                                    <div class="form-group">
                                        <label for="">High Security Password <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" ng-maxlength="4" ng-model="cltcontactdata.high_security_password" name="high_security_password" required>

                                            <div class="help-block" ng-show="btnAddContact" ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.high_security_password.$error">
                                                <div ng-message="required" class="sp-err" >High security password  cannot be blank.</div>
                                                <div ng-message="maxlength"  class="sp-err" >Maximum 4 Characters Allowed</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Status <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <div class="radio">
                                                <label>
                                                    <input name="status" type="radio" ng-model="cltcontactdata.status" value="1" class="colored-success" required />
                                                    <span class="text">Active</span>
                                                </label> &nbsp;
                                                <label>
                                                    <input name="status" type="radio" ng-model="cltcontactdata.status" value="0" class="colored-danger" required />
                                                    <span class="text"> Deactive</span>
                                                </label>
                                            </div>
                                            <div class="help-block" ng-show="btnAddContact"  ng-if="clt_contact_display_msg" ng-messages="frmCltContactInfo.status.$error">
                                                <div ng-message="required" class="sp-err" >Status cannot be blank.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>   
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary btn-submit-last"  ng-click="btnAddContact = true; clt_contact_display_msg = true">Submit</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
    
    <!-- Start Generate Invoice Modal-->
    
    <div class="modal fade" id="generateInvoiceModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Generate Invoice For {{ clientData.legal_name}}</h4>
                </div>

                <form ng-submit="frmCltGenerateInvoice.$valid && generateInvoice(generateData,clientData.id,service)" name="frmCltGenerateInvoice"  novalidate>
                    <div class="modal-body row">
                        <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>


                        <div class="col-lg-12 col-sm-12 col-xs-12">
                             <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Start Date<span class="sp-err">*</span></label>
                                    <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                        <p class="input-group">
                                            <input type="text" ng-model="generateData.start_date" name="start_date" id="start_date" class="form-control"  datepicker-popup="dd-MM-yyyy" is-open="opened"  datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly required/>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        <div ng-show="Submitbtn && generateForm.start_date.$invalid" ng-messages="generateForm.start_date.$error" class="help-block">
                                            <div ng-message="required" style="color: red !important;">This field is required</div>
                                        </div>
                                        </p>
                                    </div>   
                                </div>
                                <div class="col-sm-6">
                                    <label for="">End Date<span class="sp-err">*</span></label>
                                    <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                        <p class="input-group">
                                            <input type="text" ng-model="generateData.end_date" name="end_date" id="end_date" class="form-control"  datepicker-popup="dd-MM-yyyy" is-open="opened" max-date="dt" datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly required/>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        <div ng-show="Submitbtn && generateForm.end_date.$invalid" ng-messages="generateForm.end_date.$error" class="help-block">
                                            <div ng-message="required" style="color: red !important;">This field is required</div>
                                        </div>
                                        </p>
                                    </div>                                
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="service" ng-model="service" >
                                <div class="col-sm-6">
                                    <label for="">Invoice Date<span class="sp-err">*</span></label>
                                        <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                            <p class="input-group">
                                                <input type="text" ng-model="generateData.invoice_date" name="invoice_date" id="invoice_date" class="form-control"  datepicker-popup="dd-MM-yyyy" is-open="opened"  datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly required/>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            <div ng-show="Submitbtn && generateForm.invoice_date.$invalid" ng-messages="generateForm.invoice_date.$error" class="help-block">
                                                <div ng-message="required" style="color: red !important;">This field is required</div>
                                            </div>
                                            </p>
                                        </div> 
                                </div>
<!--                                <div class="col-sm-6">
                                         <label for="">Firms & Parners</label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="generateData.company_id" name="company_id"  class="form-control">
                                                <option value="">Please select Firms & Parners</option>
                                                <option ng-repeat="listfirm in firmspartnerslist  track by $index" value="{{listfirm.id}}" >{{listfirm.marketing_name}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                        </span>                         
                                </div>-->
                            </div>

                    </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary btn-submit-last" ng-disabled="{{invoicebtn}}"  ng-click="Submitbtn = true;">Generate</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
    <!-- End Generate Invoice Modal-->



</div>
