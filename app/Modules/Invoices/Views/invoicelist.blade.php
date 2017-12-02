<style>
    a{
    cursor: pointer;
    /*color: blue;*/ 
}
</style>
<div class="row" ng-controller="invoicesController" ng-init="manageClientInvoices(<?php echo $clientId; ?>)">  
    <div>
        <flash-message duration="5000"></flash-message>
    </div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header col-xs-12 col-md-12">

                <div class=" col-xs-12 col-md-12" style="border-top:1px dotted #ccc;padding-top:10px;">
                    <div class="row">    
                        <p style="float:left">
                            Manage Invoices of <strong>{{clientName}}</strong>
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
                
            </div><br>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                        <tr>
                            <th style="width:2%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'id'; reverseSort = !reverseSort">Sr. No.
                                    <span ng-show="orderByField == 'id'">
                                        <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                                </a>
                            </th>  
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Invoice Date
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Invoice No
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'group_name'; reverseSort = !reverseSort">Total Amount
                                    <span ng-show="orderByField == 'group_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'marketing_name'; reverseSort = !reverseSort">Service Tax
                                    <span ng-show="orderByField == 'marketing_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>                            
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'legal_name'; reverseSort = !reverseSort">PDF
                                    <span ng-show="orderByField == 'legal_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">Regenerate Invoice
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in clientsInvoiceList| filter:search |itemsPerPage:itemsPerPage">
                            <td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                            <td>{{ list.invoice_date | date : "dd-MMM-yyyy"}}</td> 
                            <td>{{ list.invoice_no}}</td> 
                            <td>{{ list.total_amount}}</td> 
                            <td>{{ list.servicetax_total}}</td> 
                            <?php 
                             $s3Path = config('global.s3Path')."/invoices/".$clientId."/";
                             $uploads_dir = base_path() . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR;
                            ?>
                            <td><a href="<?php echo $s3Path;?>{{list.invoice_file}}" target='_blank' class='link'> Download</a></td> 
                            <td><a id="btn_{{list.invoice_id}}" data-toggle="modal" data-target="#generateInvoiceModal" class="link" ng-click="initialRegenerateInvoiceModal(list.invoice_id)">Regenerate</a><!-- ng-click="regenerateInvoice(list.id);" -->
                                <img class="hide" id="loaderimg_{{list.id}}" src="images/ajax-loader.gif " />
                            </td>
                        </tr>
                        <tr ng-if='totalrecords == 0'>
                            <td colspan='7' ng-show="(clientsInvoiceList|filter:search).length == 0" align='center'>No Records Found</td>
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
    
    <div class="modal fade" id="generateInvoiceModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Regenerate Invoice For {{ clientName }}</h4>
                </div>

                <form ng-submit="frmCltGenerateInvoice.$valid && regenerateInvoice(generateData)" name="frmCltGenerateInvoice"  novalidate>
                    <div class="modal-body row">
                        <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>
                        <input type="hidden" ng-model="generateData.invoice_id" name="invoice_id" class="form-control">
                        
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
                            </div>
<!--                            <div class="row">
                                <div class="col-sm-6" >
                                         <label for="">Firms & Parners</label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="generateData.company_id" name="company_id" id="company_id" class="form-control">
                                                <option value="">Please select Firms & Partners</option>
                                                <option ng-repeat="listfirm in firmspartnerslist  track by $index" ng-selected="{{ listfirm.id == generateData.company_id}}" value="{{listfirm.id}}" >{{listfirm.marketing_name}}</option>
                                            </select>
                                            <i class="fa fa-sort-desc"></i>
                                        </span>                         
                                </div>
                            </div>-->

                    </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary btn-submit-last" ng-disabled="{{invoicebtn}}"  ng-click="Submitbtn = true;">Regenerate</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
    <!-- End Generate Invoice Modal-->
</div>



