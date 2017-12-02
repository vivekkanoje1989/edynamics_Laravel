<style>
    a{
    cursor: pointer;
    /*color: blue;*/ 
}
</style>
<div class="row" ng-controller="ctbillsettingsController" ng-init="manageClientCtnumbers(<?php echo $clientId; ?>)">  
    <div>
        <flash-message duration="5000"></flash-message>
    </div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header col-xs-12 col-md-12">

                <div class=" col-xs-12 col-md-12" style="border-top:1px dotted #ccc;padding-top:10px;">
                    <div class="row">    
                        <p style="float:left">
                            Manage Virtual Numbers Bills Settings Of <strong>{{clientName}}</strong>
                        </p>    

                    </div>
                </div>
            </div>
        </div>
        <div class="widget-body table-responsive">  
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <label for="search">Search:</label>
                    <input type="text" ng-model="search" class="form-control" style="width:25%;"  placeholder="Search">
                </div>
                <div class="col-sm-2 col-xs-12">
                    <label for="search">Records per page:</label>
                    <input type="text" style="width:120px;" type="text" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   minlength="1" maxlength="3" style="width:25%;" class="form-control" ng-model="itemsPerPage">
                </div>
                 <p style="float: right">
                         <a href="" data-toggle="modal" data-target="#addnumbersModal"  ng-click="initialaddnumbersModal(clientData.id)" class="btn btn-primary btn-info">Add New Number</a>&nbsp;&nbsp;&nbsp;
                  </p>
                
            </div><br>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                        <tr>
                            <th style="width:5%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'id'; reverseSort = !reverseSort">Sr. No.
                                    <span ng-show="orderByField == 'id'">
                                        <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                                </a>
                            </th>  
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Virtual Number
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                             <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Display Number
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Incoming Pulse Duration
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'group_name'; reverseSort = !reverseSort">Incoming Pulse Rate
                                    <span ng-show="orderByField == 'group_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
<!--                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'marketing_name'; reverseSort = !reverseSort">Outbound Pulse Duration
                                    <span ng-show="orderByField == 'marketing_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>                            
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'legal_name'; reverseSort = !reverseSort">Outbound Pulse Rate
                                    <span ng-show="orderByField == 'legal_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>-->
                           
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Activation Date
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Rent Amount
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                             <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Number Status
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                             <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Deactivation Date
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>	
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Action
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>	
                                    </span>
                                </a>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in ctnumbersList | filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                            <td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                            <td>{{ list.virtual_number }}</td> 
                            <td>{{ list.display_number }}</td> 
                            <td>{{ list.incoming_pulse_duration }} Sec</td> 
                            <td>{{ list.incoming_pulse_rate }} Paise</td> 
<!--                            <td ng-if="list.outbound_call_status == 1">{{ list.outbound_pulse_duration }}</td> 
                            <td ng-if="list.outbound_call_status == 1">{{ list.outbound_pulse_rate }}</td> -->
                            <td>{{ list.activation_date | date : "dd-MMM-yyyy"}}</td> 
                            <td>{{ list.rent_amount }}</td> 
                            <td  ng-if="list.number_status == 1">Active</td> 
                            <td  ng-if="list.number_status == 2">Freezed</td> 
                            <td  ng-if="list.number_status == 3">Zero Rental</td> 
                            <td  ng-if="list.number_status == 4">Deactive</td> 
                            
                            <td ng-if="list.deactivation_date != '0000-00-00'">{{ list.deactivation_date | date : "dd-MMM-yyyy"}}</td> 
                            <td ng-if="list.deactivation_date == '0000-00-00'"> - </td> 
                            <td>
                             <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#addnumbersModal"><a href="javascript:void(0);" ng-click="initialCtNumbersModal({{ list.id}})"><i class="fa fa-pencil"></i></a></div>    
                            </td>
                        </tr>
                        <tr ng-if='totalrecords == 0'>
                            <td colspan='10'  align='center'>No Records Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="DTTTFooter">
                <div class="col-sm-6">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page No. {{noOfRows}}</div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginate">
                        <dir-pagination-controls class="pagination" on-page-change="pageChangeHandler(newPageNumber)" max-size="5" direction-links="true" boundary-links="true"></dir-pagination-controls>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Start Generate Invoice Modal-->
    
    <div class="modal fade" id="addnumbersModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Add New Number with settings For {{ clientName }}</h4>
                </div>

                <form ng-submit="frmctnumbers.$valid && addctnumberssettings(ctnumbersData)" name="frmctnumbers"  novalidate>
                    <div class="modal-body row">
                        <input type="hidden"  name="client_id" ng-model="ctnumbersData.client_id">
                        <input type="hidden"  name="id" ng-model="ctnumbersData.id">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Virtual Number<span class="sp-err">*</span></label>
                                    <input type="text" class="form-control" name="virtual_number" ng-model="ctnumbersData.virtual_number" maxlength="12" ng-pattern="/[0-9]/" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required />
                                    <div class="help-block" ng-show="Submitbtn" ng-messages="frmctnumbers.virtual_number.$error">
                                        <div ng-message="required" class="sp-err " >Virtual number can not be blank</div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Display Number</label>
                                    <input type="text" class="form-control" name="display_number" ng-model="ctnumbersData.display_number" maxlength="12"  ng-pattern="/[0-9]/" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required />
                                    <div class="help-block" ng-show="Submitbtn" ng-messages="frmctnumbers.display_number.$error">
                                        <div ng-message="required" class="sp-err " >Display number can not be blank</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                  <div class="col-sm-6" ng-init="ctnumbersData.incoming_call_status = 1;">
                                       <label for="">Incoming Call Status </label>
                                        <div>
                                        <label><input ng-if="ctnumbersData.incoming_call_status == 1" class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.incoming_call_status=0;" checked="" ><span  class="text"></span></label>    
                                        </div>
                                        <div>
                                            <label><input ng-if="ctnumbersData.incoming_call_status == 0" class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.incoming_call_status=1;" ><span  class="text"></span></label>    
                                        </div>
                                  </div>
                                 <div class="col-sm-6" ng-init="ctnumbersData.default_number = 0">
                                       <label for="">Is Default Number</label>
                                        <div ng-if="ctnumbersData.default_number == 1">
                                                <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.default_number=0;" checked="" ><span  class="text"></span></label>    
                                        </div>
                                        <div ng-if="ctnumbersData.default_number == 0">
                                            <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.default_number=1;" ><span  class="text"></span></label>    
                                        </div>
                                  </div>
                            </div>
                            <div class="row" ng-if="ctnumbersData.incoming_call_status == 1">
                                <div class="col-sm-6">
                                    <label for="">Incoming Pulse Duration<span class="sp-err">*</span></label>
                                     <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.incoming_pulse_duration" name="incoming_pulse_duration" id="incoming_pulse_duration" class="form-control" required>
                                                <option value="">Please select incoming pulse duration</option>
                                                <option value="15">15 Sec</option>
                                                <option value="30">30 Sec</option>
                                                <option value="60">60 Sec</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.incoming_pulse_duration.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Incoming Pulse Rate<span class="sp-err">*</span></label>
                                         <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.incoming_pulse_rate" name="incoming_pulse_rate" id="incoming_pulse_rate" class="form-control" required>
                                                <option value="">Please select incoming pulse rate</option>
                                                <option value="1">1 Paise</option>
                                                <option value="30">30 Paise</option>
                                                <option value="100">100 Paise</option>
                                                <option value="120">1.2 Paise</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.incoming_pulse_rate.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>                       
                                </div>
                            </div>
                            <div class="row">
                                  <div class="col-sm-6"  ng-init="ctnumbersData.outbound_call_status = 0">
                                       <label for="">Outgoing Call Status </label>
                                        <div ng-if="ctnumbersData.outbound_call_status == 1">
                                        <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.outbound_call_status=0;" checked="" ><span  class="text"></span></label>    
                                        </div>
                                        <div ng-if="ctnumbersData.outbound_call_status == 0">
                                            <label><input class="checkbox-slider slider-icon colored-primary" type="checkbox" id="statuschk1" ng-click="ctnumbersData.outbound_call_status=1;" ><span  class="text"></span></label>    
                                        </div>
                                  </div>
                            </div>
                            <div class="row" ng-if="ctnumbersData.outbound_call_status == 1">
                                <div class="col-sm-6">
                                    <label for=""> Local Outgoing Pulse Duration<span class="sp-err">*</span></label>
                                     <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.local_outbound_pulse_duration" name="local_outbound_pulse_duration" id="local_outbound_pulse_duration" class="form-control">
                                                <option value="">Please select local outgoing pulse duration</option>
                                                <option value="15">15 Sec</option>
                                                <option value="30">30 Sec</option>
                                                <option value="60">60 Sec</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.local_outbound_pulse_duration.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for=""> Local Outgoing Pulse Rate<span class="sp-err">*</span></label>
                                         <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.local_outbound_pulse_rate" name="local_outbound_pulse_rate" id="local_outbound_pulse_rate" class="form-control">
                                                <option value="">Please select local outgoing pulse rate</option>
                                                <option value="1">1 Paise</option>
                                                <option value="30">30 Paise</option>
                                                <option value="100">100 Paise</option>
                                                 <option value="120">1.2 Paise</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.local_outbound_pulse_rate.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>                       
                                </div>
                            </div>
                            <div class="row" ng-if="ctnumbersData.outbound_call_status == 1">
                                <div class="col-sm-6">
                                    <label for="">ISD Outgoing Pulse Duration<span class="sp-err">*</span></label>
                                     <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.isd_outbound_pulse_duration" name="isd_outbound_pulse_duration" id="isd_outbound_pulse_duration" class="form-control">
                                                <option value="">Please select isd outgoing pulse duration</option>
                                                <option value="15">15 Sec</option>
                                                <option value="30">30 Sec</option>
                                                <option value="60">60 Sec</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.isd_outbound_pulse_duration.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">ISD Outgoing Pulse Rate<span class="sp-err">*</span></label>
                                         <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.isd_outbound_pulse_rate" name="isd_outbound_pulse_rate" id="isd_outbound_pulse_rate" class="form-control">
                                                <option value="">Please select isd outgoing pulse rate</option>
                                                <option value="1">1 Paise</option>
                                                <option value="30">30 Paise</option>
                                                <option value="100">100 Paise</option>
                                                <option value="120">1.2 Paise</option>
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.isd_outbound_pulse_rate.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>                       
                                </div>
                            </div>
                            <div class="row" ng-if="ctnumbersData.outbound_call_status == 1">
                                <div class="col-sm-6">
                                    <label for="">Dial Outbound Call As<span class="sp-err">*</span></label>
                                     <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.dial_outbound_callas" name="dial_outbound_callas" id="dial_outbound_callas" class="form-control">
                                                <option value="">Please select dial outbound call as</option>
                                                <option value="1">Local / STD</option>
                                                <option value="2">ISD</option>
                                               
                                            </select>
                                          <div ng-show="Submitbtn " ng-messages="ctnumbersData.dial_outbound_callas.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Activation Date<span class="sp-err">*</span></label>
                                    <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                        <p class="input-group">
                                            <input type="text" ng-model="ctnumbersData.activation_date" name="activation_date" id="activation_date" class="form-control"  datepicker-popup="dd-MM-yyyy" is-open="opened"  datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly required/>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        <div ng-show="Submitbtn " ng-messages="frmctnumbers.activation_date.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>
                                        </p>
                                    </div>   
                                </div>
                                <div class="col-sm-6" ng-controller="ctnumberstatusctrl">
                                         <label for="">Number Status</label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="ctnumbersData.number_status" name="number_status" id="number_status" class="form-control">
                                                <option value="">Please select number status</option>
                                                <option ng-repeat="list in numberstatuslist  track by $index" ng-selected="{{ list.id == ctnumbersData.number_status}}" value="{{list.id}}" >{{list.status_name}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                        </span>                         
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                         <label for="">Rent Amount<span class="sp-err">*</span></label>
                                       <input type="text" ng-model="ctnumbersData.rent_amount" name="rent_amount" id="rent_amount" class="form-control" required/>
                                         <div ng-show="Submitbtn " ng-messages="frmctnumbers.rent_amount.$error" class="help-block">
                                            <div ng-message="required" class="sp-err">This field is required</div>
                                        </div>                        
                                </div>
                                <div class="col-sm-6" ng-if="ctnumbersData.number_status == 4">
                                    <label for="">Deactivation Date</label>
                                    <div ng-controller="DatepickerDemoCtrl" class="form-group">
                                        <p class="input-group">
                                            <input type="text" ng-model="ctnumbersData.deactivation_date" name="deactivation_date" id="deactivation_date" class="form-control"  datepicker-popup="dd-MM-yyyy" is-open="opened" max-date="dt" datepicker-options="dateOptions" close-text="Close" ng-click="toggleMin()" readonly />
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                            </span>
                                        </p>
                                    </div>                                
                                </div>
                                
                            </div>

                    </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary btn-submit-last" ng-disabled="{{ctnumberbtn}}"  ng-click="Submitbtn = true;">Submit</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
    <!-- End Generate Invoice Modal-->
</div>



