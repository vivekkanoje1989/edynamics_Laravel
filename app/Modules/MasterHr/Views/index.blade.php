<style>
	.input-sm {
		height: 30px !important; 
		padding: 5px 20px !important;
		font-size: 12px !important;
		line-height: 1.5 !important;
		border-radius: 3px !important;
	}

	.modal-header {
		border-bottom: 3px solid rgb(234, 49, 1);
	}

	.hd {
		background-color: #eee0;
		background-image: -moz-linear-gradient(top,#f2f2f2 0,#fafafa 100%);
		background-image: -o-linear-gradient(top,#f2f2f2 0,#fafafa 100%);
		background-image: linear-gradient(to bottom,#f2f2f2 0,#fafafa 100%);
		font-size: 12px;
	}	

	div.dataTables_info {
    	padding: 8px;
	}
    .btn-xs{
        width: 118px !important;
        margin-bottom: 4px !important;
    }
</style>
<!--Page Related styles-->
<link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />

<!--Skin Script: Place this script in head to load scripts for skins and rtl support (maximize minimize close pane)-->
<!--script src="assets/js/skins.min.js"></script-->

<div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style="position: relative; top: -98px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="vbreadcumbs = [
            {'displayName': 'Home', 'url': 'goDashboard()'},
            {'displayName': 'Hr', 'url': 'goListemployee()'},
            {'displayName': 'Employee Management', 'url': 'goListemployee()'},
            {'displayName': 'List Employee', 'url': 'goListemployee()'}
        ]">
    <ol class="breadcrumb" >
        <i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
        <li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="javascript:void(0)" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
        </li>
    </ol>
</div>
<div class="col-xs-12 col-md-12" ng-controller="hrController" ng-init="manageUsers('', 'index')">
	<div class="widget">
		<div class="widget-header ">
			<span class="widget-caption">List Employee</span>
			<!--div class="widget-buttons">
				<a href="#" data-toggle="maximize">
					<i class="fa fa-expand"></i>
				</a>
				<a href="#" data-toggle="collapse">
					<i class="fa fa-minus"></i>
				</a>
				<a href="#" data-toggle="dispose">
					<i class="fa fa-times"></i>
				</a>
			</div-->
		</div>
		<div class="widget-body">
			<div class="table-toolbar">
				<a href="javascript:void(0);" class="btn btn-default" ng-click="userCreate()" >{{adnBtn}}</a>
				<!--a href="[[ config('global.backendUrl') ]]#/user/create" class="btn btn-default" >{{adnBtn}}</a-->
				<a href="javascript:void(0);" class="btn btn-default" ng-click="quickUser()" >Quick Employee</a>
				<div class="btn-group pull-right">
					<a class="btn btn-default toggleForm" href=""><i class="btn-label fa fa-filter"></i>Show Filter</a>
				</div>
				</div>
				<div role="grid" id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="DTTT btn-group">
						<a class="btn btn-default DTTT_button_print" id="ToolTables_editabledatatable_1" title="View print view" ng-click="ExportToxls()" >
							<span>Export</span> <!--href="/manageVerticals/exportToxls"-->
						</a>
                        <!--a class="btn btn-default DTTT_button_print" href="[[ config('global.backendUrl') ]]#/user/showpermissions" >
							<span>Permission Wise Users</span> 
						</a-->
                         <a class="btn btn-default DTTT_button_print" href="javascript:void(0);" ng-click="permissionWUser()" >
							<span>Permission Wise Employee</span> 
						</a>
						<!--a class="btn btn-default DTTT_button_collection" id="ToolTables_editabledatatable_2">
							<span>Action</span>
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu dropdown-default">
								<li>
									<a href="" ng-click="checkteest()">Test Mail</a>
								</li>
								<li>
									<a href="javascript:void(0);">Another action</a>
								</li>
								<li>
									<a href="javascript:void(0);">Something else here</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);">Separated link</a>
								</li>
							</ul>
						</a-->
					</div>
				<div  class="dataTables_filter">
					<label>
						<input type="search" class="form-control input-sm" ng-model="search" name="search" style="width: 269px;">
					</label>
				</div>
				<!-- filter data--> 
                <div class="row" style="border:2px;" id="filter-show">
                    <div class="col-md-12">
                        <b ng-repeat="(key, value) in searchData" ng-if="value != 0 && key != 'toDate'">
                            <div class="col-md-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="label graded fade in" style="margin-left: -15px;padding: 10px; margin-bottom: 10px; border: 1px solid #5db2ff; background-color: white;color:black;">
                                    <button class="close" style="line-height: 0;padding: 5px;" ng-click="removeFilterData('{{ key}}');" data-dismiss="alert">×</button>
                                    <strong ng-if="key === 'firstName'" data-toggle="tooltip" title="Employee Name"><strong>Employee Name : </strong> {{ value}}</strong>
                                    <strong ng-if="key === 'designation'" data-toggle="tooltip" title="Designation"><strong>Designation : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'departmentName'"  data-toggle="tooltip" title="Department"><strong>Department : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'team_lead_name'"  data-toggle="tooltip" title="Team Lead"><strong>Team Lead : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'reporting_to_name'"  data-toggle="tooltip" title="Reporting To"><strong>Reporting To : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'joining_date'"  data-toggle="tooltip" title="Joining Date"><strong>Joining Date : </strong>{{ searchData.joining_date | date:'dd-MM-yyyy' }} </strong>
                                    <strong ng-if="key === 'login_date_time'"  data-toggle="tooltip" title="Last Login Date"><strong>Last Login Date : </strong>{{ value}} </strong>
                                    <strong ng-if="key === 'employee_status'"  data-toggle="tooltip" title=""><strong>Employee Status: </strong>{{ searchData.employee_status == 1? 'Active':'Temporary Suspended'}} </strong>
                                </div>
                            </div>
                        </b>                        
                    </div>
                </div>
                <!-- filter data-->
				<div class="dataTables_length" >					
					<label>                        
                        <select class="form-control input-sm" ng-model="itemsPerPage" name="itemsPerPage" onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            <option ng-repeat="val in itemsPerPageModel" >{{val}}</option>                        
                        </select>
					</label>
				</div>
				<table class="table table-striped table-hover table-bordered dataTable no-footer" at-config="config">
					<thead >
						<tr role="row" style=" background-color: #eee; background-image: -moz-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: -o-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: linear-gradient(to bottom,#f2f2f2 0,#fafafa 100%); font-size: 12px;">
							<th  rowspan="1" colspan="1" style="width: 1px !important;" >Sr.No.</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Employee')">Employee Name</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Designation')">Designation</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Reporting To')">Reporting To</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Team Lead')">Team Lead</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Departments')">Departments</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Joining Date')">Joining Date</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Status of User')">Status of User</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction('Last Login')">Last Login</th>
							<th  rowspan="1" colspan="1" style="width: 170px;"></th>							
						</tr>
					</thead>
					<tbody>
						<tr  role="row" dir-paginate="list in listUsers | itemsPerPage:itemsPerPage | filter:search | filter:searchData  | orderBy: OrderRec " >
							<td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>							
                            <td>{{ list.firstName}}</td>
                            <td>{{ list.designation == null? '-' : list.designation}}</td>
                            <td>{{ list.reporting_to_name == null? '-': list.reporting_to_name}}</td>
                            <td>{{ list.team_lead_name == null? '-': list.team_lead_name }}</td>
                            <td>{{ list.departmentName.split(',').join(', ') == null?'-':list.departmentName.split(',').join(', ')}}</td>
                            <td>{{ list.joining_date == '0000-00-00' ? '-' : list.joining_date | date : "dd-MM-yyyy"  }}</td>
                            <td ng-if="list.employee_status == 1">Active</td>
                            <td ng-if="list.employee_status == 2">Temporary Suspended</td>
                            <td ng-if="list.employee_status == 3">Permanent Suspended</td>
                            <td>{{ list.login_date_time == null ? '-' : list.login_date_time | date : "dd-MM-yyyy"  }}</td>                          
                            <td >
								<a href="[[ config('global.backendUrl') ]]#/user/permissions/{{ list.id}}" class="btn btn-success btn-xs edit" tooltip-html-unsafe="User Permissions" ><i class="fa fa-user-plus"></i> Permissions</a>
								<a href="[[ config('global.backendUrl') ]]#/user/update/{{ list.id}}" class="btn btn-info btn-xs edit" tooltip-html-unsafe="Edit User" ><i class="fa fa-edit"></i> Edit</a>
								<a href="javascript:void(0);" class="btn btn-warning btn-xs edit" tooltip-html-unsafe="Change Password" data-toggle="modal" data-target="#myModal" ng-click="manageUsers({{ list.id}},'resetPassword')"  ><i class="fa fa-lock"></i> Reset Password</a>
								<a href="javascript:void(0);" class="btn btn-danger btn-xs delete" tooltip-html-unsafe="Suspend Employee"  data-toggle="modal" data-target="#myModal" ng-click='manageUsers({{ list.id}},"deleteUser")' ><i class="fa fa-user-times"></i> Suspend</a>
							</td>
						</tr>					
				</tbody>			
			</table>
			<div class="DTTTFooter">
                <div class="col-sm-6">
                	<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing page {{noOfRows}} of {{ listUsers.length }} entries</div>
                	<!--div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing page {{noOfRows}} from {{itemsPerPage * (noOfRows-1)+1}} to {{(itemsPerPage * (noOfRows-1))+itemsPerPage}}  of {{ verticalRowLength }} entries</div-->
                   <!--div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page No. {{noOfRows}}</div-->
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

<!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header widget-header bordered-bottom bordered-themeprimary">
                    <!-- loader-->
                    <i class='fa fa-spinner fa-spin ' style="color: #3fc3e8; font-size: 25px;position: fixed; left: 4px;" ng-show="vloader"></i>
            
                    <button type="button" id="passwordClosebtn" class="close" ng-click="step1 = false" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{modelHeading}}</h4>
                </div>
                <!--form name="userForm" novalidate ng-submit="userForm.$valid && changePassword(modal)"-->
                <form name="userForm" novalidate ng-submit="userForm.$valid && doAction(modal)">
                    <div class="modal-body">
                        <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken='<?php echo csrf_token(); ?>'" class="form-control">

                        <div class="form-group">
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="modal.firstName" name="firstName" style="text-transform: capitalize;" placeholder="First Name">
                                <i class="fa fa-user thm-color circular"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="modal.lastName" name="lastName" style="text-transform: capitalize;" placeholder="Last Name">
                                <i class="fa fa-user thm-color circular"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="modal.userName" name="userName" placeholder="User Name">
                                <i class="fa fa-user thm-color circular"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon icon-right">
                                <input type="password" id="passTggField" class="form-control" ng-model="modal.password" name="password" placeholder="New Password" ng-if="modelOldpass">
                                <i class="fa fa-eye thm-color circular" id="passTgg" ng-click="togglePass()" ng-if="modelOldpass"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="modal.old_password" name="old_password" placeholder="Old Password" ng-if="modelOldpass">                                
                                <i class="fa fa-key thm-color circular" aria-hidden="true" ng-if="modelOldpass"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="submit" class="btn btn-sub" ng-click="step1 = true">{{modelBtn}}</button>
                        <button type="button" class="btn btn-sub" ng-click="Cancel()" ng-show="modelCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Model ends-->

 <!-- Filter Form Start-->
    <div class="wrap-filter-form show-widget" id="slideout">
        <form name="hrFilter" role="form" ng-submit="filterDetails(searchDetails)" class="embed-contact-form">
            <div  class="row widget-header bordered-bottom bordered-themeprimary" style="box-shadow: 0px 0px 0px 0px; margin-bottom: 10px;">
                <strong style="position: absolute; left: 15px; top: 5px;">Filter</strong>   
                <button type="button" class="close toggleForm" aria-label="Close" style="margin-right: 15px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row scrollform">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Employee Name</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.firstName" name="firstName" class="form-control" oninput="if (/[^A-Za-z]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z]/g,'')">
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Designation</label>
                        <span class="input-icon icon-right">
                            <select ng-model="searchDetails.designation" name="designation" ng-controller="designationCtrl" class="form-control">
                                <option value="">Please Select Designation</option>
                                <option ng-repeat="list in designationList track by $index" value="{{list.designation}}" ng-selected="{{ userData.designation == list.designation}}">{{list.designation}}</option>
                            </select>
                            <i class="fa fa-sort-desc"></i>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Department</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.departmentName" name="departmentName" class="form-control" oninput="if (/[^A-Za-z]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z]/g,'')">
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Team Lead</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.team_lead_name" name="team_lead_name" class="form-control" oninput="if (/[^A-Za-z]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z]/g,'')">
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Reporting To</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.reporting_to_name" name="reporting_to_name" class="form-control" oninput="if (/[^A-Za-z]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z]/g,'')">
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12" ng-controller="DatepickerDemoCtrl">
                    <div class="form-group">
                        <label for="">Joining Date</label>
                        <span class="input-icon icon-right">
                            <p class="input-group">
                                <input type="text" ng-model="searchDetails.joining_date" placeholder="Joining date" name="joining_date" id="fromDate" class="form-control" datepicker-popup="d-MM-yyyy" is-open="opened" max-date=maxDate datepicker-options="dateOptions" close-text="Close" ng-change="clearToDate()" ng-click="toggleMin()" readonly/>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                            </p>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12" ng-controller="DatepickerDemoCtrl">
                    <div class="form-group">
                        <label for="">Last Login Date</label>
                        <span class="input-icon icon-right">
                            <p class="input-group">
                                <input type="text" ng-model="searchDetails.login_date_time" placeholder="Last login date" name="login_date_time" class="form-control" datepicker-popup="d-MM-yyyy" is-open="opened" max-date=maxDate datepicker-options="dateOptions" close-text="Close" ng-change="clearToDate()" ng-click="toggleMin()" readonly/>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                            </p>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Employee status</label>
                        <span class="input-icon icon-right">
                            <select ng-model="searchDetails.employee_status" name="employee_status" class="form-control">
                                <option value="">Select status </option>
                                <option value="1">Active </option>
                                <option value="2">Temporary Suspended </option>
                            </select>

                        </span>    
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="form-group">
                        <span class="input-icon icon-right" align="center">
                            <button type="submit" name="sbtbtn" value="Search" class="btn btn-default toggleForm">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="/js/filterSlider.js"></script>
    <!-- Filter Form End-->
</div><!--end-->


<!--Beyond Scripts-->
<!--script src="assets/js/beyond.min.js"></script-->