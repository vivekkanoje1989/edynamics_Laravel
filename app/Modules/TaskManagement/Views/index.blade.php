<!-- New view viveknk-->
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

    .check-btn{
        padding-right: 67px;
    }
</style>
<!--Page Related styles-->
<link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />

<!--Skin Script: Place this script in head to load scripts for skins and rtl support (maximize minimize close pane)-->
<!--script src="assets/js/skins.min.js"></script-->

<div class="col-xs-12 col-md-12" ng-controller="taskManagement" ng-init="getTasklist(); getTmStatus(); vbreadcumbs = [
				{'displayName': 'Home', 'url': 'goDashboard()'},
				{'displayName': 'Task Management', 'url': ''},
				{'displayName': 'Task List', 'url': ''}
			]">
	<div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style=" position: relative; top: -98px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="">
		<ol class="breadcrumb" >
			<i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
			<li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="javascript:void(0)" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
			</li>
		</ol>
	</div>
	<div class="widget">
		<div class="widget-header ">
			<span class="widget-caption">Task List</span>
			<span class="widget-caption pull-right "><a class="themeprimary" data-toggle="modal" title="Help Info" data-target="#help"><i class="fa fa-question-circle" aria-hidden="true" style="font-size: 25px;margin-right: 15px; margin-top: 6px;"></i></a></span>

			<!---div class="widget-buttons">
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
				<a id="editabledatatable_new" href="javascript:void(0);" class="btn btn-default"  ng-click="goaddtask()">Add New Task</a>
				<div class="btn-group pull-right">
					<a class="btn btn-default toggleForm" href=""><i class="btn-label fa fa-filter"></i>Show Filter</a>
				</div>
				</div>
				<div role="grid" id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="DTTT btn-group">
						<!--a class="btn btn-default DTTT_button_print" id="ToolTables_editabledatatable_1" title="View print view" ng-click="ExportToxls('module')" >
							<span>Export</span>
						</a-->
						<a class="btn btn-default DTTT_button_collection" id="ToolTables_editabledatatable_2">
							<span>Action</span>
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu dropdown-default">
								<li>
									<a href="javascript:void(0);" title="View print view" ng-click="ExportToxls('module')">Export</a>
								</li>
								<!--li>
									<a href="javascript:void(0);">Another action</a>
								</li>
								<li>
									<a href="javascript:void(0);">Something else here</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);">Separated link</a>
								</li-->
							</ul>
						</a>
					</div>
				<div  class="dataTables_filter">
					<label>
						<input type="search" class="form-control input-sm" ng-model="search" name="search" >
					</label>
				</div>
				<!-- filter data--> 
                <div class="row" style="border:2px;" id="filter-show">
                    <div class="col-sm-12 col-xs-12">
                        <b ng-repeat="(key, value) in searchData" ng-if="value != 0 && key != 'toDate'">
                            <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="label graded fade in" style="margin-left: -15px;padding: 10px; margin-bottom: 10px; border: 1px solid #5db2ff; background-color: white;color:black;">
                                    <button class="close" style="padding-left:8px;margin-top: -5px;color:black;" ng-click="removeFilterData('{{ key}}');" data-dismiss="alert"> ×</button>
                                    <strong ng-if="key === 'id'" data-toggle="tooltip" title="Task ID"><strong> Task ID : </strong> {{ value}}</strong>
                                    <strong ng-if="key === 'sub_module_name'" data-toggle="tooltip" title="Sub Module Name"><strong> Sub Module : </strong> {{ value}}</strong>
                                    <strong ng-if="key === 'priority_name'" data-toggle="tooltip" title="Priority Name"><strong> Priority : </strong> {{ value}}</strong>
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
							<th  rowspan="1" colspan="1" style="width: 5px !important;" >Sr.No.</th>
							<th  rowspan="1" colspan="1" style="width: 1px !important;" >ID</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 200px;" ng-click="OrderFunction()">Sub Module</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 450px;" ng-click="OrderFunction()">Task Details</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="" ng-click="OrderFunction()">Issued Date</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="" ng-click="OrderFunction()">Estimated Date</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="" ng-click="OrderFunction()">Priority</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="" ng-click="OrderFunction()">Completion Date</th>
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="" ng-click="OrderFunction()">Remark</th>
							<th  rowspan="1" colspan="1" aria-label="status" style="width: 170px;"></th>
						</tr>
					</thead>
					<tbody>
						<tr  role="row" dir-paginate="list in TasklistRow | itemsPerPage:itemsPerPage | filter:search | filter:searchData  | orderBy: OrderRec " >
							<td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>							
                            <td>{{list.id}}</td>							
                            <td>{{list.sub_module_name}}</td>							
                            <td>{{list.task_details}}</td>							
                            <td>{{list.issued_date}}</td>							
                            <td>{{list.estimated_date}}</td>							
                            <td>{{list.priority_name}}</td>							
                            <td>{{list.completion_date}}</td>							
                            <td>{{list.remark}}</td>                          					
							<td >
								<a href="#" class="btn btn-info btn-xs edit" tooltip-html-unsafe="View Details" data-toggle="modal" data-target="#productModal" ng-click='initialModal("{{ list.id}}","{{list.product_name}}","{{ itemsPerPage}}","{{$index}}"," ")'><i class="fa fa-eye"></i> View</a>
								<a ng-if="!list.completion_date" href="#" class="btn btn-success btn-xs check-btn" tooltip-html-unsafe="Give remark & Approve"  data-toggle="modal" data-target="#tasklistModal" ng-click='initModal("{{ list.id}}")' style="width: 88px;"><i class="fa fa-check"></i> Approve</a>
								<a ng-if="list.completion_date" href="javascript:void(0);" class="btn btn-default btn-xs check-btn" tooltip-html-unsafe="Approved" style="width: 88px;"  ><i class="fa fa-thumbs-o-up"></i> APPROVED</a>
							</td>
						</tr>					
				</tbody>			
			</table>

			<div class="DTTTFooter">
                <div class="col-sm-6">
                	<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" >Showing page {{noOfRows}} of {{ TasklistLength }} entries </div>
                	<!--div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" >Showing page {{noOfRows}} from {{itemsPerPage*(noOfRows-1)+1}} to {{(itemsPerPage*(noOfRows-1))+ itemsPerPage}} of {{ bloodGrpLength }} entries </div-->
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
<!--model-->
<div class="modal fade" id="tasklistModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header widget-header bordered-bottom bordered-themeprimary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>
                <form novalidate ng-submit="tasklistForm.$valid && doTasklistAction(id, remark)" name="tasklistForm">
                    <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                    <div class="modal-body">
                        <div class="form-group" ng-class="{ 'has-error' : sbtBtn && (!tasklistForm.remark.$dirty && tasklistForm.remark.$invalid)}">
                            <input type="hidden" class="form-control" ng-model="id" name="id">
                            <label>Remark<span class="sp-err">*</span></label> 
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="remark" name="remark" ng-change="errorMsg = null" required>
                                <div class="help-block" ng-show="sbtBtn" ng-messages="tasklistForm.remark.$error">
                                    <div ng-message="required">This field is required</div>
                                    <div ng-if="errorMsg" class="err">{{errorMsg}}</div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-sub" ng-click="sbtBtn = true">{{action}}</button>
                        <button type="button" class="btn btn-sub" ng-click="Cancel()" ng-disabled="vertBtn" ng-if="cancl">Cancel</button>                        
                    </div> 
                </form>           
            </div>
        </div>
    </div>

	<!--model Help-->
	<div class="modal fade" id="help" role="dialog" tabindex="-1" >    
        <div class="modal-dialog">           
            <div class="modal-content" style="border: 3px solid azure;border-radius: 30px;height: 489px; background: #0e0e0e38;overflow: auto;">
                <div class="modal-header widget-header bordered-bottom bordered-themeprimary" style="border-radius: 27px; margin-top: 25px; width: 90%;margin-left: 20px;margin-right: 20px;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title" align="center">Task List Help Info</h4>
                </div>                
                <div class="modal-body" style="">
                    <div class="form-group ">
						<div class="form-group col-sm-3">
							<label style="font-family: serif;font-size: 17px;">Task List<span class="sp-err"> : </span></label>
						</div>
						<div class="form-group col-sm-9">
							<p style="font-family: serif;font-size: 17px;">This shows the list of tasks assigned.<p>
                        </div>				
                    </div> 
					<div class="form-group ">
						<div class="form-group col-sm-3">
							<label style="font-family: serif;font-size: 17px;">Task List<span class="sp-err"> : </span></label>
						</div>
						<div class="form-group col-sm-9">
							<p style="font-family: serif;font-size: 17px;">This shows the list of tasks assigned.<p>
                        </div>				
                    </div> 					                           
                </div>                       
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
                        <label for="">Task ID</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.id" name="id" class="form-control">
                        </span>
                    </div>
                </div>

				<div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Sub Module</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.sub_module_name" name="sub_module_name" class="form-control">
                        </span>
                    </div>
                </div>

				<div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Priority</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.priority_name" name="priority_name" class="form-control">
                        </span>
                    </div>
                </div>
				
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="form-group">
                        <span class="input-icon icon-right" >
                            <button type="submit"  style="margin-left: 46%;" name="sbtbtn" value="Search" class="btn btn-default toggleForm">Search</button>
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