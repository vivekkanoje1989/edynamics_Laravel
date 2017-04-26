<div class="row" ng-controller="clientInfoCtrl" >  
    <div class="col-xs-12 col-md-12" >
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Manage Clients</span>

                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
            </div>
            <div class="widget-body table-responsive">     
                <form ng-submit="frmcrtClients.$valid"  name="frmcrtClients"  novalidate enctype="multipart/form-data">
                    <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                    <table class="table table-hover table-striped table-bordered" at-config="config" ng-controller="currentCountryListCtrl">
                        <thead class="bord-bot">
                            <tr>
                                <td colspan="2">Create Client</td>
                            <tr>
                        </thead>
                        <tbody>
                        <input type="hidden" ng-model="id" name="blogId" id="blogId">    
                        <tr>
                            <td>Client Groups<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group" >
                                    <span class="input-icon icon-right">
                                        <select ng-model="group_id" ng-controller="getClientGroupsCtrl" name="group_id" class="form-control" required="required">
                                            <option value="">Select Client Groups</option>
                                            <option ng-repeat="clientGrpObj in clientGroupsList" value="{{clientGrpObj.id}}" ng-selected="{{ clientGrpObj.id == group_id}}">{{clientGrpObj.group_name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.group_id.$error">
                                            <div ng-message="required" class="sp-err" >Client Groups cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Marketing Name<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-maxlength="50" ng-model="marketing_name" name="marketing_name" required>
                                    <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.marketing_name.$error">
                                            <div ng-message="required" class="sp-err" >Marketing Name cannot be blank.</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 50 Characters Allowed</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Legal Name<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-maxlength="30" ng-model="legal_name" name="legal_name" required>
                                    <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.legal_name.$error">
                                            <div ng-message="required" class="sp-err" >Legal Name cannot be blank.</div>
                                            <div ng-message="maxlength"  class="sp-err" >Maximum 30 Characters Allowed</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Company<span class="sp-err">*</span></td>
                            <td>
                                                               
                                <div class="form-group" ng-controller="getCompanyTypeCtrl">
                                    <span class="input-icon icon-right">
                                        <select ng-model="type_of_company" name="type_of_company" class="form-control" required="required">
                                            <option value="">Select Company</option>
                                            <option ng-repeat="companyTypeObj in companyTypeList" value="{{companyTypeObj.id}}" ng-selected="{{ companyTypeObj.id == type_of_company}}">{{companyTypeObj.type_of_company}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.type_of_company.$error">
                                            <div ng-message="required" class="sp-err" >Company cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Company Logo<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <input type="file" ngf-select   ng-model="company_logo" name="company_logo" id="company_logo" accept="image/*" ngf-max-size="2MB" class="form-control imageFile"  ngf-model-invalid="errorFile" >
                                </div>
                                <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.company_logo.$error">
                                            <div ng-message="required" class="sp-err" >Company Logo cannot be blank.</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Address<span class="sp-err">*</span></td>
                            <td>
                                <textarea ng-model="office_addres" name="office_addres"  ng-attr-rows="{{row || '4'}}"  class="form-control" required></textarea>
                                <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.office_addres.$error">
                                            <div ng-message="required" class="sp-err" >Office address cannot be blank.</div>
                                </div>
                            </td>
                        </tr>
                       <tr>
                            <td>Pin Code<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-model="pin_code" ng-maxlength="6" name="pin_code" required>
                                    <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.pin_code.$error">
                                            <div ng-message="required" class="sp-err" >Pin code cannot be blank.</div>
                                            <div ng-message="maxlength" class="sp-err" >Maximum 30 Characters Allowed</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                         <tr>
                            <td>Country<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <span class="input-icon icon-right">
                                        <select ng-model="country_id" ng-change="onCountryChange()" id="current_country_id"  name="country_id" class="form-control" required="required">
                                            <option value="">Select Country</option>
                                            <option ng-repeat="countryObj in countryList" value="{{countryObj.id}}" ng-selected="{{ countryObj.id == country_id}}">{{countryObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.country_id.$error">
                                            <div ng-message="required" class="sp-err" >Country cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>State<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <span class="input-icon icon-right">
                                        <select ng-model="state_id"  ng-change="onStateChange()" name="state_id" id="current_state_id" class="form-control" required>
                                                        <option value="">Select State</option>
                                                        <option ng-repeat="stateObj in stateList" value="{{stateObj.id}}" ng-selected="{{ stateObj.id == state_id}}">{{stateObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.state_id.$error">
                                            <div ng-message="required" class="sp-err" >City cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>

                            </td>
                        </tr>
                         <tr>
                            <td>City<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <span class="input-icon icon-right">
                                        <select ng-model="city_id"  name="city_id" class="form-control" required>
                                                        <option value="">Select City</option>
                                                        <option ng-repeat="cityObj in cityList" value="{{cityObj.id}}" ng-selected="{{ cityObj.id == state_id}}">{{cityObj.name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.city_id.$error">
                                            <div ng-message="required" class="sp-err" >City cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        
                        
                        <tr><td>Website Url<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <input type="url" class="form-control" name="website" ng-model="website" required />
                                    <div class="help-block" ng-show="btnClientInfo" ng-messages="frmcrtClients.website.$error">
                                            <div ng-message="required" class="sp-err" >URL cannot be blank.</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr><td>Website With<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                    <div class="control-group">
                                        <div class="radio">
                                            <label>
                                                <input name="form-field-radio" type="radio" ng-model="website_with" value="0" class="colored-success">
                                                <span class="text">Website provided by and managed by us</span>
                                            </label> &nbsp;
                                            <label>
                                                <input name="form-field-radio" type="radio" ng-model="website_with" value="1" class="colored-danger">
                                                <span class="text"> Website is with another service provider</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Right Click<span class="sp-err">*</span></td>
                            <td>
                                <div class="form-group">
                                <div class="control-group">
                                    <div class="radio">
                                        <label>
                                            <input name="form-field-radio" type="radio" ng-model="right_click" value="1" class="colored-success">
                                            <span class="text">Enable</span>
                                        </label> &nbsp;
                                        <label>
                                            <input name="form-field-radio" type="radio" ng-model="right_click" value="0" class="colored-danger">
                                            <span class="text"> Disable</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="Submit" class="btn btn-sub" ng-click="btnClientInfo = true">Submit</button></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>