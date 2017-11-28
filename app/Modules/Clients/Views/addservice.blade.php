
<style>
    .actions {
        z-index: 0 !important;
    }
    .help-block {
        margin-top: 0px !important; 
        margin-bottom: 0px !important; 
        color: #e46f61;
    }
    .toggleClassActive {font-size:40px !important;cursor:pointer;color: #5cb85c !important;vertical-align: middle;margin-left: 15px;}
    .toggleClassInactive {font-size:40px !important;cursor:pointer;color: #d9534f !important;vertical-align: middle;margin-left: 15px;}
</style>

<div ng-controller="clientInfoCtrl">
    <form ng-submit="frmServices.$valid && createService(serviceData,discountInfo)"  name="frmServices"  novalidate enctype="multipart/form-data" ng-init="manageserviceswithdiscount(<?php echo $clientId.','.$serviceId; ?>)" >
        <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
        <?php
        if (empty($clientId))
            $clientId = 0;
        if(empty($serviceId))
            $serviceId = 0;
        
        ?>           

        <div style="display:none">{{serviceData.clientid = <?php echo $clientId; ?>}}</div> 
        <div style="display:none">{{serviceData.serviceid = <?php echo $serviceId; ?>}}</div> 
        <input type="hidden" ng-model="serviceData.clientid"  name="clientid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <h5 class="row-title before-themeprimary"><i class="fa  fa-arrow-circle-o-right themeprimary"></i>{{ clientData.legal_name}}</h5>
                <div class="step-content" id="WiredWizardsteps">
                    <div class="step-pane active" id="wiredstep1">
                        <div class="form-title">Add Service</div>
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="">Select Service Name<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <select ng-model="serviceData.service_id" name="service_id" class="form-control" ng-disabled="isUpdate" required="required">
                                            <option value="">Select Service Name</option>
                                            <option ng-repeat="clientservices in clientservicesList"  value="{{clientservices.id}}" ng-selected="{{ clientservices.id == serviceData.service_id}}">{{clientservices.service_name}}</option>
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div class="help-block step1" ng-show="btnService" ng-messages="frmServices.service_id.$error">
                                            <div ng-message="required" class="sp-err" >Service name cannot be blank</div>
                                        </div>
                                        <!--<a href="" data-toggle="modal" data-target="#addserviceModal" >Add Service</a>&nbsp;&nbsp;&nbsp;-->
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6" ng-if="serviceData.service_id != 3">
                                <div class="form-group">
                                    <label for="">Unit(Quantity)</label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="5" maxlength="5"   ng-model="serviceData.unit" name="unit" >
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6" ng-if="serviceData.service_id != 3">
                                <div class="form-group">
                                    <label for="">Price (Rate)<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="5" maxlength="5" ng-model="serviceData.price" name="price" required>
                                        <div class="help-block step1" ng-show="btnService" ng-messages="frmServices.price.$error">
                                            <div ng-message="required" class="sp-err" >Price cannot be blank.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6" ng-if="serviceData.service_id == 3">
                                <label for="">Number of PRI Line</label>
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" ng-maxlength="8" ng-change="gettotalprice(serviceData.pri,serviceData.pri_price);" maxlength="8" ng-model="serviceData.pri" name="pri" >
                                    
                                </span>
                            </div>
                            <div class="col-sm-3 col-xs-6" ng-if="serviceData.service_id == 3">
                                <div class="form-group">
                                    <label for="">PRI Lines Price<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="8" ng-change="gettotalprice(serviceData.pri,serviceData.pri_price);" maxlength="8" ng-model="serviceData.pri_price" name="pri_price" >
                                    </span>
                                </div>
                            </div>
                        </div>    

                        <div class="row">
                            
                            <div class="col-sm-3 col-xs-6" ng-if="serviceData.service_id == 3">
                                <div class="form-group">
                                    <label for="">Total Pricing<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="text" class="form-control" ng-maxlength="8" maxlength="8" ng-model="serviceData.total_price" name="total_price" readonly="">
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group" ng-init="serviceData.status=1;">
                                    <label for="">Status</label>
                                    <div>
                                        <label>
                                         <input class="checkbox-slider slider-icon colored-primary" ng-if="serviceData.status === 1" type="checkbox" id="statuschk1" checked="" ng-click="isStatusChange(0);">
                                         <span  class="text"></span>
                                     </label>   
                                     <label>
                                             <input class="checkbox-slider slider-icon colored-primary" ng-if="serviceData.status === 0"  type="checkbox" id="statuschk1"  ng-click="isStatusChange(1);">
                                         <span  class="text"></span>
                                      </label>   
                                    </div>
                                 </div>
                            </div>

                            
                        </div>    
                          
                       
                    </div>       
                    <div class="step-pane active" id="wiredstep1">
                        <div class="form-title ">Manage Discount</div>
                        <div class="row">
                            <p style="float: right">
                                <a href="" data-toggle="modal" data-target="#addDiscountModal" ng-click="initialDiscountModal(0, '', 0, '',serviceData.service_id)" class="btn btn-primary btn-info">Add Discount</a>&nbsp;&nbsp;&nbsp;
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
                                                    <th style="width: 20%">
                                                        Discount Type
                                                    </th>  

                                                    <th style="width: 20%">
                                                        Discount Amount
                                                    </th>
                                                    <th style="width: 20%">
                                                        Applicable Month
                                                    </th>
                                                    <th style="width: 5%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" dir-paginate="list in discountInfo| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                                                    <td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                                                    <td>{{ list.discount_for }}</td> 
                                                    <td>{{ list.discount_amt}}</td>  
                                                    <td>{{ list.applicable_month | date:'MMM yyyy' }}</td>
                                                    <td class="fa-div">
                                                        <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#addDiscountModal"><a href="javascript:void(0);" ng-click="initialDiscountModal({{ list.id}},{{list}},1, $index,serviceData.service_id)"><i class="fa fa-pencil"></i></a></div>
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
                                <button type="submit" class="btn btn-primary btn-submit-last"  ng-click="btnService = true;">Submit</button>&nbsp;&nbsp;&nbsp;
                            </p>
                        </div>    
                    </div> 
                    
                </div>   
            </div>

        </div>
    </form>
    
    
    <div class="modal fade" id="addserviceModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Add Service</h4>
                </div>
                <form ng-submit="frmMlstService.$valid && addMlstServices(mlstserviceData)" name="frmMlstService"  novalidate>
                     <div class="modal-body row">
                     <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="">Enter Service Name<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                          <input type="text" class="form-control" ng-maxlength="15" maxlength="15" ng-model="mlstserviceData.service_name" name="service_name" required>
                                    </span>
                                    <div ng-show="btnAddmlstservice"  ng-messages="frmMlstService.service_name.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">service name cannot be blank</div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="">Enter HSN/SAC Number<span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                          <input type="text" class="form-control" ng-maxlength="25" maxlength="25" ng-model="mlstserviceData.hsn_sac" name="hsn_sac" required>
                                    </span>
                                    <div ng-show="btnAddmlstservice"  ng-messages="frmMlstService.hsn_sac.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">HSN/SAC cannot be blank</div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                         <div class="row">
                                <div class="col-sm-6" style="margin-top: 22px;">
                                    <div class="form-group">
                                        <p><button type="submit" class="btn btn-primary btn-submit-last"  ng-click="btnAddmlstservice = true;">Submit</button>&nbsp;&nbsp;&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                     </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addDiscountModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
           
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Add Discount</h4>
                </div>

                <form ng-submit="frmdiscountdata.$valid && processDiscount(discountdata)" name="frmdiscountdata"  novalidate>
                    <div class="modal-body row">
                        <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>


                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" ng-model="discountdata.id" name="id">
                                        <label>Discount Amount<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" name="discount_amt" ng-model="discountdata.discount_amt" maxlength="7" required />
                                            <div class="help-block"  ng-show="btndiscount" ng-messages="frmdiscountdata.discount_amt.$error">
                                                <div ng-message="required" class="sp-err" >Discount amount cannot be blank</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Discount Type<span class='sp-err'>*</span></label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="discountdata.discount_for_id"  name="discount_for_id" id="discount_for_id" class="form-control" required="required">
                                                <option value="">Select Discount Type</option>
                                                <option ng-repeat="discount in discountlist track by $index" value="{{discount.id}}" ng-selected="{{ discount.id == discountdata.discount_for_id}}">{{discount.discount_name}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                            <div ng-show="btndiscount"  ng-messages="frmdiscountdata.discount_for_id.$error" class="help-block">
                                                <div ng-message="required" class="sp-err">Discount type cannot be blank</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Applicable Month <span class="sp-err">*</span></label>
                                        <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                            <p class="input-group">
                                                <input type="text" ng-model="discountdata.applicable_month" name="applicable_month" id="applicable_month" class="form-control" datepicker-popup="MMM yyyy" is-open="opened"  datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly required/>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            <div ng-show="Savebtn && discountFrom.applicable_month.$invalid" ng-messages="discountFrom.applicable_month.$error" class="help-block">
                                                <div ng-message="required" style="color: red !important;">This field is required</div>
                                            </div>
                                            </p>
                                        </div>     
                                    </div>
                                </div>  
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Status <span class="sp-err">*</span></label>
                                        <span class="input-icon icon-right">
                                            <div class="radio">
                                                <label>
                                                    <input name="status" type="radio" ng-model="discountdata.status" value="1" class="colored-success" required />
                                                    <span class="text">Active</span>
                                                </label> &nbsp;
                                                <label>
                                                    <input name="status" type="radio" ng-model="discountdata.status" value="0" class="colored-danger" required />
                                                    <span class="text"> Deactive</span>
                                                </label>
                                            </div>
                                            <div class="help-block" ng-show="btndiscount"  ng-messages="frmdiscountdata.status.$error">
                                                <div ng-message="required" class="sp-err" >Status cannot be blank.</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary btn-submit-last"  ng-click="btndiscount = true;">Submit</button>
                    </div> 

                    </div>
                    
                </form>           
            </div>
        </div>
    </div>




</div>




