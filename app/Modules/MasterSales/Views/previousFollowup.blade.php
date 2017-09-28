<style>    
     .close {
        color:black;
    }
.alert.alert-info {
    border-color: 1px solid #d9d9d9;
    background-color: #f5f5f5;
    border: 1px solid #d9d9d9;
    color: black;
    padding: 5px;
}
</style>
<div class="row" ng-controller="enquiryController" ng-init="previousFollowups('', [[$type]],1, [[config('global.recordsPerPage')]],3)" >
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
              <span class="widget-caption">{{pagetitle}}</span>
            </div>
            <div  class="widget-body table-responsive">                
                <div class="row">
                    <div class="col-sm-5 col-xs-12" style="float:left">
                        <div class="col-sm-3 center">
                            <input type="text" minlength="1" maxlength="3" placeholder="Records per page" ng-model="itemsPerPage" ng-change="previousFollowups('', [[$type]],{{pageNumber}}, itemsPerPage,3)" ng-model-options="{ updateOn: 'blur' }" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control">
                        </div>
                        <div class="col-sm-4 center">
                            <button type="button" class="btn btn-primary ng-click-active" style="float: right;margin-left: 10px;" data-toggle="modal" data-target="#showFilterModal" ng-click="procName('proc_get_previous_followups')">
                                <i class="btn-label fa fa-filter"></i>Show Filter</button>
                        </div>
                        <div ng-if="enquiriesLength != 0 " class="col-sm-3 center">
                            <a href="" class="btn btn-primary" id="downloadExcel" download="{{fileUrl}}"  ng-show="dnExcelSheet">
                                <i class="btn-label fa fa-file-excel-o"></i>Download excel</a>
                            <a href="javascript:void(0);" id="exportExcel" uploadfile class="btn btn-primary" ng-click="exportReport(enquiries)" ng-show="btnExport">
                                <i class="btn-label fa fa-file-excel-o"></i>Export to Excel
                            </a> 
                        </div>                                       
                    </div>

                    <div class="col-sm-7 col-xs-12 dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginat">                         
                        <span ng-if="enquiriesLength != 0 " >&nbsp; &nbsp; &nbsp; Showing {{enquiries.length}}  Enquiries Out Of Total {{ enquiriesLength}} Enquiries.  &nbsp;</span>
                        <dir-pagination-controls max-size="5"  class="pull-right pagination" on-page-change="pageChanged(newPageNumber,'previousFollowups','', [[$type]], newPageNumber)" template-url="/dirPagination"  ng-if="enquiriesLength"></dir-pagination-controls>
                    </div>
                </div> 
               <hr>
                <div class="row" style="border:2px;" id="filter-show">
                    <b ng-repeat="(key, value) in showFilterData" ng-if="key != 'toDate'">                         
                        <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_')) }}" ng-if="value != ''">
                            <div class="alert alert-info fade in">
                                <button class="close" ng-click=" removeDataFromFilter('{{ key }}');" data-dismiss="alert"> ×</button>
                                <strong ng-if="key === 'channel_id' || key === 'city_id' || key === 'category_id' || key === 'source_id' || key == 'status_id' "><strong>{{  key.substring(0, key.indexOf('_')) }} :</strong>{{  value.substring(value.indexOf("_")+1) }}</strong>
                                <strong ng-if="key === 'employee_id' " ng-repeat='emp in value track by $index'> {{ $index +1 }}){{   emp.first_name  }}  {{ emp.last_name }} </strong>
                                <strong ng-if="key === 'subcategory_id' " ng-repeat='subcat in value track by $index'> {{ $index +1 }}){{   subcat.enquiry_sales_subcategory  }}</strong>
                                <strong ng-if="key === 'subsource_id' " ng-repeat='subsource in value track by $index'> {{ $index +1 }}){{ subsource.sub_source }} </strong>
                                <strong ng-if="key === 'substatus_id' " ng-repeat='substatus in value track by $index'>{{ $index +1 }}) {{ substatus.enquiry_sales_substatus }} </strong>
                                <strong ng-if="key === 'enquiry_locations' " ng-repeat='loc in value track by $index'>{{ $index +1 }}) {{ loc.location }} </strong>
                                <strong ng-if="key === 'project_id'" ng-repeat='project in value track by $index'>{{ $index +1 }}) {{ project.project_name }}</strong>
                                <strong ng-if="key === 'verifiedEmailId'"> <strong>Verified Email ID:</strong>Yes</strong>
                                <strong ng-if="key === 'verifiedMobNo'" data-toggle="tooltip" title="Verified Mobile Number"> <strong>Verified Mobile:</strong>Yes</strong>
                                <strong ng-if="key === 'site_visited' " data-toggle="tooltip" title="Site Visited"> <strong ng-if="value == 1">Site Visit:Yes</strong>
                                    <strong ng-if="value == 0">Site Visit:No</strong>
                                </strong>
                                <strong ng-if="key === 'loan_required'" data-toggle="tooltip" title="Loan Required"> <strong ng-if="value == 1">Loan Required:Yes</strong>
                                    <strong ng-if="value == 0">Loan Required:No</strong>
                                </strong>
                                <strong ng-if="key === 'parking_required' " data-toggle="tooltip" title="Parking Required"> <strong ng-if="value == 1">Parking Required:Yes</strong>
                                    <strong ng-if="value == 0">Parking Required:No</strong>
                                </strong>
                                <strong ng-if="key === 'fromDate'"  data-toggle="tooltip" title="Enquiry Date"><strong>Enquiry Date:</strong>{{ showFilterData.fromDate | date:'dd-MMM-yyyy' }} To {{ showFilterData.toDate |date:'dd-MMM-yyyy' }}</strong>
                                <!--<strong ng-if="key != 'channel_id' && key != 'city_id' && key != 'project_id' && key != 'substatus_id' && key != 'subsource_id' && key != 'subcategory_id' && key != 'category_id' && key != 'fromDate' && key != 'toDate' && key != 'source_id' && key != 'employee_id' && key!='status_id' " data-toggle="tooltip" title="{{ key }}">{{ value}}</strong>-->
                                <strong ng-if="key == 'fname' || key == 'mobileNumber' || key == 'lname' || key == 'emailId'" data-toggle="tooltip" title="{{ key }}">{{ value}}</strong>
                            </div>
                        </div>
                    </b>
                    <b ng-if="min != 0 || max != 0 ">
                        <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_')) }}" ng-if="value != ''">
                            <div class="alert alert-info fade in">
                               <button class="close" ng-click=" removeDataFromFilter('min');" data-dismiss="alert"> ×</button>
                               <strong>
                                   Budget Limit : {{ min }} To {{ max }}
                               </strong>
                            </div>
                        </div>
                    </b>
               </div> 
                <br>
                <table ng-if="enquiriesLength" class="table table-hover table-striped table-bordered" at-config="config">
                    <thead>
                        <tr>                            
                            <th class="enq-table-th">SR</th>
                            <th class="enq-table-th">Customer</th>
                            <th class="enq-table-th">Enquiry</th>
                            <th class="enq-table-th">History</th>
                            <th class="enq-table-th">Next</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr dir-paginate="enquiry in filtered = ( enquiries | filter:search)  | itemsPerPage: itemsPerPage | orderBy:orderByField:reverseSort" total-items="{{ enquiriesLength }}">
                            <td width="4%">{{ itemsPerPage * (pageNumber - 1) + $index + 1}}</td>
                            <td width="20%">
                                <div>{{enquiry.customer_title}} {{ enquiry.customer_fname}} {{ enquiry.customer_lname}}</div>
                                <div ng-if="[[Auth::guard('admin')->user()->customer_contact_numbers]] == 1" ng-init="mobile_list=enquiry.mobile.split(',')">  
                                    <span ng-repeat="mobile_obj in mobile_list | limitTo:2">
                                    <a style="cursor: pointer;" class="Linkhref"
                                           ng-if="mobile_obj != null" 
                                           ng-click="cloudCallingLog(1,<?php echo Auth::guard('admin')->user()->id; ?>,'<?php if (!empty(Auth::guard('admin')->user()->office_mobile_no)) {
                                            echo Auth::guard('admin')->user()->office_mobile_no;
                                        } else {
                                            echo Auth::guard('admin')->user()->personal_mobile1;
                                            } ?>','{{ enquiry.mobile_number}}','<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>',{{ enquiry.id}},<?php echo Auth::guard('admin')->user()->client_id; ?>)">

                                        <img src="/images/call.png" title="Click on call icon to make a call" class="hi-icon-effect-8 psdn_session" style="height: 17px;width: 17px;" />
                                    </a>
                                        {{ mobile_obj}}
                                    </span>
                                </div>
                                <div>
                                    <p ng-if="[[ Auth::guard('admin')->user()->customer_contact_numbers]] == 0 && enquiry.mobile_number !='' "> +91-xxxxxx{{  enquiry.mobile_number.substring(enquiry.mobile_number.length - 4, enquiry.mobile_number.length)}}</p>
                                    <p ng-if="<?php echo Auth::guard('admin')->user()->customer_email; ?> == 1 && enquiry.email != '' " ng-init="all_email_list=enquiry.email.split(',');" >
                                        
                                        <span ng-repeat="emailobj in all_email_list | limitTo:2">
                                                {{emailobj}}
                                                <span ng-if="$index == 0 && all_email_list.length >= 2">
                                                    /
                                                </span>
                                              
                                        </span>
                                        
                                    </p>
                                </div>
                                <hr class="enq-hr-line">
                                <div>
                                    <a target="_blank" href="[[ config('global.backendUrl') ]]#/sales/update/cid/{{ enquiry.customer_id}}"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;Customer Id ({{enquiry.customer_id}})</a>
                                </div>                    
                                <hr class="enq-hr-line">
                                <div>
                                    <span ng-if="enquiry.sales_source_name != '' && enquiry.enquiry_sub_source != null "
                                          ng-init="sourceleng = enquiry.sales_source_name.length + enquiry.enquiry_sub_source.length; source = enquiry.sales_source_name +' / '+ enquiry.enquiry_sub_source ">
                                        <strong>Source : </strong>
                                        <span data-toggle="tooltip" title="{{source}}">{{source | limitTo : 45}} </span>
                                        <span ng-if="source.length  > 45" data-toggle="tooltip" title="{{source}}">...</span>
                                    </span>
                                    <span ng-if="enquiry.sales_source_name != '' && enquiry.enquiry_sub_source == null ">
                                        <strong>Source : </strong>
                                        <span data-toggle="tooltip" title="{{enquiry.sales_source_name}}">    {{enquiry.sales_source_name | limitTo : 45}} </span>
                                        <span ng-if="enquiry.sales_source_name.length  > 45" data-toggle="tooltip" title="{{enquiry.sales_source_name}}">...</span>
                                    </span>
                                </div>
                                <div ng-if="enquiry.area != '' &&  enquiry.area != null " >
                                    <hr class="enq-hr-line">
                                    <strong>Area : </strong>
                                    <span data-toggle="tooltip" title="{{enquiry.area}}">    {{enquiry.area | limitTo : 45}} </span>
                                    <span ng-if="enquiry.area  > 45" data-toggle="tooltip" title="{{enquiry.area}}">...</span>
                                </div>
                            </td>                            
                            <td width="20%">
                                <div>
                                    <span ng-if="enquiry.sales_status != '' && enquiry.enquiry_sales_substatus == null"> 
                                        <b>Status : </b>  
                                        <span data-toggle="tooltip" title="{{enquiry.sales_status}}">{{ enquiry.sales_status  | limitTo : 45 }}</span>
                                        <span ng-if="enquiry.sales_status  > 45" data-toggle="tooltip" title="{{enquiry.sales_status}}">...</span>
                            <hr class="enq-hr-line">
                                    </span>                                    
                                    <span ng-if="enquiry.sales_status != '' && enquiry.enquiry_sales_substatus != null" ng-init="enquiry_status_length = enquiry.sales_status.length + enquiry.enquiry_sales_substatus.length; enquiry_status = enquiry.sales_status +' / '+ enquiry.enquiry_sales_substatus "> 
                                            <b>Status : </b>  
                                            <span data-toggle="tooltip" title="{{enquiry_status}}">{{ enquiry_status  | limitTo : 45 }}</span>
                                            <span ng-if="enquiry_status_length > 45" data-toggle="tooltip" title="{{enquiry_status}}">...</span>
                            <hr class="enq-hr-line">
                                    </span>                                    
                                </div>        
                                <div> 
                                    <span ng-if="enquiry.enquiry_category != '' && enquiry.enquiry_sales_subcategory == null" data-toggle="tooltip" title="{{enquiry.enquiry_category}}">
                                        <b>Category : </b>  
                                        {{ enquiry.enquiry_category  | limitTo : 45 }}
                                        <span ng-if="enquiry.enquiry_category > 45" data-toggle="tooltip" title="{{enquiry.enquiry_category}}">...</span>
                                         <hr class="enq-hr-line">
                                    </span>
                                    <span ng-if="enquiry.enquiry_category != '' && enquiry.enquiry_sales_subcategory != null " data-toggle="tooltip" title="{{enquiry_sales_subcategory}}" ng-init="enquiry_sales_subcategory_length = enquiry.enquiry_sales_subcategory.length + enquiry.enquiry_sales_subcategory.length; enquiry_sales_subcategory = enquiry.enquiry_category +' / '+ enquiry.enquiry_sales_subcategory ">
                                        <b>Category : </b>  
                                        {{ enquiry_sales_subcategory  | limitTo : 45 }}
                                        <span ng-if="enquiry_sales_subcategory_length  > 45" data-toggle="tooltip" title="{{enquiry_sales_subcategory}}">...</span>
                                        <hr class="enq-hr-line">
                                    </span>                                
                                </div>
                                <div>                                   
                                    <span ng-if="enquiry.project_block_name != null && enquiry.project_block_name != '' " data-toggle="tooltip" title="{{enquiry.project_block_name}}">                                    
                                        <b>Project :</b>
                                         {{enquiry.project_block_name | limitTo : 45 }}
                                        <span ng-if="enquiry.project_block_name > 45" data-toggle="tooltip" title="{{enquiry.project_block_name}}">...</span>                                                                        
                                         <hr class="enq-hr-line">
                                    </span>
                                </div>
                                <div>
                                    <span style="text-align: center;"><a target="_blank" href="[[ config('global.backendUrl') ]]#/sales/update/cid/{{ enquiry.customer_id }}/eid/{{ enquiry.id}}"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;Enquiry Id ({{ enquiry.id}})</a></span>
                                </div>    
                                
                            </td>
                             <td width="30%">
                                <div><b>Enquiry Owner :</b> {{enquiry.owner_fname}} {{enquiry.owner_lname}}</div>                                
                                <hr class="enq-hr-line">
                                <div >
                                    <b>Last followup : </b>{{ enquiry.last_followup_date}}
                                </div>
                                <div><b>By {{enquiry.followupby_fname}} {{enquiry.followupby_lname}} : </b>
                                        <span data-toggle="tooltip" title="{{enquiry.remarks | removeHTMLTags}}">{{enquiry.remarks | limitTo : 100 | removeHTMLTags }}
                                            <span ng-if="enquiry.remarks.length  >100" data-toggle="tooltip" title="{{enquiry.remarks | removeHTMLTags}}">...</span>
                                        </span></div>
                                <hr class="enq-hr-line">
                                <div>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#historyDataModal" ng-click="initHistoryDataModal({{ enquiry.id}})"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;View History</a>
                                </div>

                            </td>
                            <td width="13%">
                                <div><b>Followup due : </b>{{ enquiry.next_followup_date}} @ {{ enquiry.next_followup_time}}</div>                            
                            </td>
                        </tr>
                        <tr>
                          <td colspan="7"  ng-show="(enquiries|filter:search).length==0" align="center">Record Not Found</td>   
                        </tr>
                    </tbody>
                </table>
                <hr>
               <dir-pagination-controls   max-size="5"  class="pull-right pagination" on-page-change="pageChanged(newPageNumber,'previousFollowups','', [[$type]], newPageNumber)" template-url="/dirPagination" ng-if="enquiriesLength"></dir-pagination-controls>
               <div ng-if="enquiriesLength == 0 ">
                    <div>
                        <center><b>No Enquiries Found</b></center>
                    </div>
                </div>
                </div>
            <!-- Modal -->
            <!-- Today history model =============================================================================-->
            <div class="modal fade" id="historyDataModal" role="dialog" tabindex='-1'>
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header navbar-inner">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" align="center">Enquiry History</h4>
                        </div>
                        <!--<div data-ng-include=" '/MasterSales/enquiryhistory'"></div>-->
                        <div class="modal-footer" align="center">
                        </div>
                    </div>
                </div>
            </div>
            <div data-ng-include="'/MasterSales/showFilter'"></div>
        </div>
    </div>
</div>

