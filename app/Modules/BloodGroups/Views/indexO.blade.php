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

<div class="row" ng-controller="bloodsGroupCtrl" ng-init="manageBloodGroup()">  
    <div class="mainDiv col-xs-12 col-md-12">
        <div class="widget flat radius-bordered">
            <div class="widget-header bordered-bottom bordered-themeprimary">
                <span class="widget-caption">Manage Blood Group</span>                
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
                                <a href="" data-toggle="modal" data-target="#bloodGroupModal" ng-click="initialModal(0, '', '')" class="btn btn-primary btn-right">Add Blood Group</a>
                                <button type="button" class="btn btn-primary btn-right toggleForm" style="margin-right: 10px;"><i class="btn-label fa fa-filter"></i>Show Filter</button>

                            </span>
                        </div>
                    </div>

                </div> 

                <div class="row" style="border:2px;" id="filter-show" ng-controller="adminController">
                    <div class="col-sm-12 col-xs-12">
                        <b ng-repeat="(key, value) in searchData" ng-if="value != 0">
                            <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="alert alert-info fade in">
                                    <button class="close" ng-click="removeFilterData('{{ key}}');" data-dismiss="alert"> ×</button>
                                    <strong ng-if="key === 'blood_group'" data-toggle="tooltip" title="Blood Group"><strong> Blood Group : </strong> {{ value}}</strong>
                                </div>
                            </div>
                        </b>                        
                    </div>
                </div>
                <!-- filter data-->
                <!--pagination top-->
                <div>
                    <div class="col-sm-6"><!--div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page No. {{noOfRows}}</div-->
                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginate">
                            <dir-pagination-controls class="pagination" on-page-change="pageChangeHandler(newPageNumber)" max-size="5" direction-links="true" boundary-links="true"></dir-pagination-controls>
                        </div>
                    </div>
                </div>
                <!--pagination top-->

                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">                    
                        <tr>
                            <th style="width:5%">Sr. No.</th>
                            <th style="width: 30%">Blood Group</th>
                            <th style="width: 5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody ng-controller="adminController">
                        <tr role="row" dir-paginate="list in bloodGrpRow | filter:search | filter:searchData | itemsPerPage: itemsPerPage" >
                            <td>{{ itemsPerPage * (pageNumber - 1) + $index + 1}}</td> 
                            <td>{{ list.blood_group}}</td>                          
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="" data-toggle="modal" data-target="#bloodGroupModal"><a href="javascript:void(0);" ng-click="initialModal({{ list.id}},'{{list.blood_group}}',{{itemsPerPage}},{{$index}})"><i class="fa fa-pencil"></i></a></div>
                                <div class="fa-hover" tooltip-html-unsafe="Delete" style="" data-toggle="modal" data-target="#bloodGroupModalD"><a href="javascript:void(0);" ng-click="initialModal({{ list.id}},'{{list.blood_group}}',{{itemsPerPage}},{{$index}})"><i class="fa fa-trash-o"></i></a></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="DTTTFooter">
                    <div class="col-sm-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page No. {{noOfRows}}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginate">
                            <dir-pagination-controls class="pagination" on-page-change="pageChangeHandler(newPageNumber)" max-size="5" direction-links="true" boundary-links="true"></dir-pagination-controls>
                        </div>
                    </div>
                </div>
                <div data-ng-include="'/BloodGroups/showFilter'"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bloodGroupModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>
                <form novalidate ng-submit="bloodGroupForm.$valid && doBloodGroupAction()" name="bloodGroupForm">
                    <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                    <div class="modal-body">
                        <div class="form-group" ng-class="{ 'has-error' : sbtBtn && (!bloodGroupForm.blood_group.$dirty && bloodGroupForm.blood_group.$invalid)}">
                            <input type="hidden" class="form-control" ng-model="id" name="id">
                            <label>Blood group<span class="sp-err">*</span></label> 
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="blood_group" name="blood_group" ng-change="errorMsg = null" required>
                                <div class="help-block" ng-show="sbtBtn" ng-messages="bloodGroupForm.blood_group.$error">
                                    <div ng-message="required">This field is required</div>
                                    <div ng-if="errorMsg" class="err">{{errorMsg}}</div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-sub btn-primary" ng-click="sbtBtn = true">{{action}}</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="bloodGroupModalD" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">Delete Blood Group</h4>
                </div>
                <form novalidate ng-submit="bloodGroupDForm.$valid && doBloodGroupDelete()" name="bloodGroupDForm">
                    <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                    <div class="modal-body">
                        <div class="form-group" ng-class="{ 'has-error' : sbtBtn && (!bloodGroupDForm.blood_group.$dirty && bloodGroupDForm.blood_group.$invalid)}">
                            <input type="hidden" class="form-control" ng-model="id" name="id">
                            <label>Blood group delete<span class="sp-err">*</span></label> 
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="blood_group" name="blood_group" ng-change="errorMsg = null" required>
                                <div class="help-block" ng-show="sbtBtn" ng-messages="bloodGroupDForm.blood_group.$error">
                                    <div ng-message="required">This field is required</div>
                                    <div ng-if="errorMsg" class="err">{{errorMsg}}</div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-sub btn-primary" ng-click="sbtBtn = true">Confirm</button>
                        <button type="button" class="btn btn-sub btn-primary" ng-click="cancel()">Cancel</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
    <!-- Filter Form Start-->
    <div class="wrap-filter-form show-widget" id="slideout">
        <form name="bloodGroupFilter" role="form" ng-submit="filterDetails(searchDetails)">
            <strong>Filter</strong>   
            <button type="button" class="close toggleForm" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button><hr>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Blood Group</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.blood_group" name="blood_group" class="form-control">
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="form-group">
                        <span class="input-icon icon-right" >
                            <button type="submit"  style="margin-left: 46%;" name="sbtbtn" value="Search" class="btn btn-primary toggleForm">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="/js/filterSlider.js"></script>
    <!-- Filter Form End-->
</div>