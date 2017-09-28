<style>
    .close {
        color:black;
    }
    .alert.alert-info {
        border-color: 1px solid #d9d9d9;
        /* background: rgba(173, 181, 185, 0.81); */
        background-color: #f5f5f5;
        border: 1px solid #d9d9d9;
        color: black;
        padding: 5px;
        width: 110%;
    }
</style>
<div class="row" ng-controller="testimonialsCtrl" ng-init="manageTestimonials()">  
    <div class="mainDiv col-xs-12 col-md-12">
        <div class="widget flat radius-bordered">
            <div class="widget-header bordered-bottom bordered-themeprimary">
                <span class="widget-caption">Testimonial</span>                
            </div>
            <div class="widget-body table-responsive">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <label for="search">Search:</label>
                            <span class="input-icon icon-right">
                                <input type="text" ng-model="search" name="search" class="form-control">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="search">Records per page:</label>
                            <input type="text" minlength="1" maxlength="3" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" style="width:30%;" class="form-control" ng-model="itemsPerPage" name="itemsPerPage">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for=""></label>
                            <span class="input-icon icon-right">
                                <button type="button" class="btn btn-primary btn-right toggleForm" style="margin-right: 10px;"><i class="btn-label fa fa-filter"></i>Show Filter</button>
                            </span>
                        </div>
                    </div>
                </div>         
                <!-- filter data-->
                <div class="row" style="border:2px;" id="filter-show">
                    <div class="col-sm-12 col-xs-12">
                        <b ng-repeat="(key, value) in searchData">
                            <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="alert alert-info fade in">
                                    <button class="close" ng-click="removeFilterData('{{ key}}');" data-dismiss="alert"> ×</button>
                                    <strong ng-if="key === 'customer_name'" data-toggle="tooltip" title="Customer Name"><strong> Customer Name : </strong> {{ value}}</strong>
                                    <strong ng-if="key === 'mobile_number'" data-toggle="tooltip" title="Mobile Number"><strong> Mobile Number : </strong> {{ value}}</strong>
                                    <strong ng-if="key === 'company_name'" data-toggle="tooltip" title="Company Name"><strong> Company Name : </strong> {{ value}}</strong>
                                    <!--<strong ng-if="key === 'approve_status'" data-toggle="tooltip" title="Status"><strong>  Status : </strong> {{ value.approve_status == 1 ? "Approved" : "Not Approve"}}</strong>-->
                                </div>
                            </div>
                        </b>                        
                    </div>
                </div>
                <!-- filter data-->
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                            <th style="width:5%">Sr.No.</th>
                            <th style="width:10%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'block_stages'; reverseSort = !reverseSort">Customer name
                                    <span ng-show="orderByField == 'customer_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th> 
                            <th style="width: 20%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'block_stages'; reverseSort = !reverseSort">Mobile No
                                    <span ng-show="orderByField == 'mobile_number'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th> 
                            <th style="width: 30%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'company_name'; reverseSort = !reverseSort">Company Name
                                    <span ng-show="orderByField == 'company_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th> 
                            <th style="width: 20%">Approve Status</th>  
                            <th style="width: 5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in ApprovedTestimonialsRow|  filter:search |filter:searchData | itemsPerPage:itemsPerPage |orderBy:orderByField:reverseSort">
                            <td>{{itemsPerPage * (noOfRows - 1) + $index + 1}}</td>
                            <td>{{ list.customer_name}}</td>  
                            <td>{{ list.mobile_number}}</td>  
                            <td>{{ list.company_name}}</td>
                            <td>{{ (list.approve_status == 1) ? "Approved" : "Not Approve"}}</td>
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" ><a href="[[ config('global.backendUrl') ]]#/testimonials-manage/update/{{ list.testimonial_id}}"><i class="fa fa-pencil"></i></a></div>
                            </td> 
                        </tr>
                    </tbody>
                </table>
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
    </div>
    <!-- Filter Form Start-->
    <div class="wrap-filter-form show-widget" id="slideout">
        <form name="bankAccountFilter" role="form" ng-submit="filterDetails(searchDetails)" class="embed-contact-form">
            <strong>Filter</strong>   
            <button type="button" class="close toggleForm" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button><hr>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.customer_name" name="customer_name" class="form-control" oninput="if (/[^A-Za-z]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z]/g,'')">
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.mobile_number" name="mobile_number" class="form-control" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.company_name" name="company_name" class="form-control">
                        </span>
                    </div>
                </div>
                <!--                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Account Type</label>
                                        <span class="input-icon icon-right">
                                            <select ng-model="searchDetails.approve_status" name="approve_status" class="form-control">
                                                <option value="">Select account type</option>
                                                <option value="1">Approved</option>
                                                <option value="2">Not Approve</option>
                                            </select>
                
                                        </span>    
                                    </div>
                                </div>-->

            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="form-group">
                        <span class="input-icon icon-right" align="center">
                            <button type="submit" name="sbtbtn" value="Search" class="btn btn-primary toggleForm">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="/js/filterSlider.js"></script>
    <!-- Filter Form End-->
</div>



