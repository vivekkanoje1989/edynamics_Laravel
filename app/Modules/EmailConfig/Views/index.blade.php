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
</style>
<!--Page Related styles-->
<link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />

<!--Skin Script: Place this script in head to load scripts for skins and rtl support (maximize minimize close pane)-->
<!--script src="assets/js/skins.min.js"></script-->

<div class="col-xs-12 col-md-12" ng-controller="emailconfigCtrl" ng-init="manageEmailConfig()">
	<div class="widget">
		<div class="widget-header ">
			<span class="widget-caption">Configure Email Accounts</span>
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
				<a id="editabledatatable_new" href="" class="btn btn-default" data-toggle="modal" data-target="#emailConfigModal" ng-click="initialModal(0, '', '', '', '','','','','')">{{adnBtn}}</a>
				<div class="btn-group pull-right">
					<a class="btn btn-default toggleForm" href=""><i class="btn-label fa fa-filter"></i>Show Filter</a>
				</div>
				</div>
				<div role="grid" id="editabledatatable_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="DTTT btn-group">
						<a class="btn btn-default DTTT_button_print" id="ToolTables_editabledatatable_1" title="View print view" ng-click="ExportToxls()" >
							<span>Export</span> <!--href="/manageVerticals/exportToxls"-->
						</a>
                        <!--a class="btn btn-default DTTT_button_print" ng-click="checkteest()" >
							<span>Test mail</span> 
						</a-->
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
						<input type="search" class="form-control input-sm" ng-model="search" name="search" >
					</label>
				</div>
				<!-- filter data--> 
                <div class="row" style="border:2px;" id="filter-show">
                    <div class="col-md-12 col-md-12">
                        <b ng-repeat="(key, value) in searchData" ng-if="value != 0 && key != 'toDate'">
                            <div class="col-md-6" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="label graded fade in" style="margin-left: -15px;padding: 10px; margin-bottom: 10px; border: 1px solid #5db2ff; background-color: white;color:black;">
                                    <button class="close" style="line-height: 0;padding: 5px;" ng-click="removeFilterData('{{ key}}');" data-dismiss="alert">×</button>
                                    <strong ng-if="key === 'email'" data-toggle="tooltip" title="Email"><strong> Email : </strong> {{ value}}</strong>
                                </div>
                            </div>
                        </b>                        
                    </div>
                </div>
                <!-- filter data-->
				<div class="dataTables_length" >
					<!--label>
						<select class="form-control input-sm" ng-model="itemsPerPage" name="itemsPerPage" onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
							<option value="30">30</option>
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="300">300</option>
							<option value="400">400</option>
							<option value="500">500</option>
							<option value="600">600</option>
							<option value="700">700</option>
							<option value="800">800</option>
							<option value="900">900</option>
							<option value="999">999</option>							
						</select>
                    </label-->
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
							<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" ng-click="OrderFunction()">Email Id</th>
							<th tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" >Password</th>
							<th tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" >Service Provider</th>
							<th tabindex="0"  rowspan="1" colspan="1" style="width: 259px;" >Departments</th>
							<th  rowspan="1" colspan="1" style="width: 170px;"></th>
						</tr>
					</thead>
					<tbody>
						<tr  role="row" dir-paginate="list in listmails | itemsPerPage:itemsPerPage | filter:search | filter:searchData  | orderBy: OrderRec " >
							<td>{{ itemsPerPage * (noOfRows - 1) + $index + 1}}</td>							
                            <td>{{ list.email}}</td>
                            <td><input type="password" value="{{list.password }}" style="border:none;background: transparent;" disabled></td>
                            <td>Gmail</td>          
                            <td>{{ list.deptName }}</td>
                            <td >
								<a href="#" class="btn btn-info btn-xs edit" tooltip-html-unsafe="Edit Email Configuration" data-toggle="modal" data-target="#emailConfigModal" ng-click='initialModal({{ list.id}},"{{list.email}}","{{list.password}}","{{list.deptName}}",{{list.project_id}},{{list.status}},{{ itemsPerPage}},{{$index}},"upd")'><i class="fa fa-edit"></i> Edit</a>
								<a href="#" class="btn btn-danger btn-xs delete" tooltip-html-unsafe="Delete Email Configuration"  data-toggle="modal" data-target="#emailConfigModal" ng-click='initialModal({{ list.id}},"{{list.email}}","{{list.password}}","{{list.deptName}}",{{list.project_id}},{{list.status}},{{ itemsPerPage}},{{$index}},"del")'><i class="fa fa-trash-o"></i> Delete</a>
							</td>
						</tr>					
				</tbody>			
			</table>
			<div class="DTTTFooter">
                <div class="col-sm-6">
                	<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing page {{noOfRows}} of {{ listmailsLength }} entries</div>
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

<!--model-->
    <div class="modal fade" id="emailConfigModal" role="dialog" tabindex="-1">   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header widget-header bordered-bottom bordered-themeprimary">
                    <!-- loader-->
                    <i class='fa fa-spinner fa-spin ' style="color: #3fc3e8; font-size: 25px;position: fixed; left: 4px;" ng-show="vloader"></i>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>                
                <form name="emailConfigForm" ng-submit="emailConfigForm.$valid && doConfEmailAction()" name="emailConfigForm">
                    <div class="row">    
                        <div class="col-md-6 col-md-6">&nbsp;</div>
                        <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                        <input type="hidden" class="form-control" ng-model="id" name="id">
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-12">                            
                            <div class="col-md-6 col-md-6">
                                <div class="form-group" ng-class="{ 'has-error' : sbtbtn && (!emailConfigForm.email.$dirty && emailConfigForm.email.$invalid)}">
                                    <label for="">Email <span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="email" ng-model="emailData.email" name="email" class="form-control" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" required ng-model-options="{ allowInvalid: true, debounce: 300 }">
                                        <div ng-show="sbtbtn" ng-messages="emailConfigForm.email.$error">
                                            <div ng-message="required">This field is required.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6">
                                <div class="form-group" ng-class="{ 'has-error' : sbtbtn && (!emailConfigForm.password.$dirty && emailConfigForm.password.$invalid)}">
                                    <label for="">Password <span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <input type="password" ng-model="emailData.password" id="password" name="password" class="form-control" required="required">                                            
                                        <span tabindex="100" title="Click here to show password" class="add-on input-group-addon" id="passToggle" style="cursor: pointer; width: 37px; position: absolute; top: 0; right: 0; padding: 8px;"><i class="glyphicon icon-eye-open glyphicon-eye-open"></i></span>
                                        <div ng-show="sbtbtn" ng-messages="emailConfigForm.password.$error">
                                            <div ng-message="required">This field is required.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-md-12">    
                            <div class="col-md-6 col-md-6">
                                <div class="form-group" ng-controller="projectCtrl" ng-class="{ 'has-error' : sbtbtn && (!emailConfigForm.project_id.$dirty && emailConfigForm.project_id.$invalid)}">
                                    <label for="">Project <span class="sp-err">*</span>{{projectList[0].id[prj_id] }}</label>	
                                    <span class="input-icon icon-right">
                                    <!--for Add-->
                                    <select ng-model="emailData.project_id" name="project_id" class="form-control" required ng-if="Add">
                                        <option value="">Select Project</option>
                                        <option ng-repeat="plist in projectList" value="{{plist.id}}" >{{plist.project_name}}</option>
                                    </select>
                                    <!--for Edit-->
                                    <select ng-model="emailData.project_id" name="project_id" class="form-control" required ng-if="Edit" >
                                        <option ng-repeat="plist in projectList | filter:{'id': prj_id}:true " value="{{plist.id}}" ng-selected="emailData.project_id">{{plist.project_name}}</option>
                                    </select>
                                    <!--for delete-->
                                    <select ng-model="emailData.project_id" name="project_id" class="form-control" required ng-if="delete" >
                                        <option ng-repeat="plist in projectList | filter:{'id': prj_id}:true " value="{{plist.id}}" ng-selected="emailData.project_id">{{plist.project_name}}</option>
                                    </select>                                   
                                    <i class="fa fa-sort-desc"></i>
                                    <div ng-show="sbtbtn" ng-messages="emailConfigForm.project_id.$error">
                                        <div ng-message="required">This field is required.</div>
                                    </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6">
                                <div class="form-group" ng-class="{ 'has-error' : sbtbtn && (!emailConfigForm.status.$dirty && emailConfigForm.status.$invalid)}">
                                     <label for="">Status <span class="sp-err">*</span></label>	
                                    <span class="input-icon icon-right">
                                        <select class="form-control" ng-model="emailData.status"  name="status" placeholder="Status" required>
                                            <option value="">Select Status</option>
                                            <option value="0">InActive</option>
                                            <option value="1">Active</option>                                            
                                        </select>
                                        <i class="fa fa-sort-desc"></i>
                                        <div ng-show="sbtbtn" ng-messages="emailConfigForm.status.$error">
                                            <div ng-message="required">This field is required.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <div class="form-group multi-sel-div" ng-class="{ 'has-error' : (sbtbtn && (!emailConfigForm.department_id.$dirty && emailConfigForm.department_id.$invalid)) && emptyDepartmentId}" >
                                    <label for="">Departments <span class="sp-err">*</span></label>	
                                    <ui-select multiple ng-model="emailData.department_id" name="department_id" theme="select2" ng-disabled="disabled" style="width: 300px;" ng-required="true" ng-change="checkDepartment()">
                                        <ui-select-match placeholder="Select Departments">{{$item.department_name}}</ui-select-match>
                                        <ui-select-choices repeat="list in listDepartment ">
                                            {{list.department_name}} 
                                        </ui-select-choices>
                                    </ui-select>
                                    <div ng-show="emptyDepartmentId" class="help-block department {{ applyClassDepartment }}">
                                       <span class="sp-err">This field is required.</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="modal-footer" align="center">                        
                        <button type="Submit" class="btn btn-sub" id="sbt" ng-click="sbtBtn = true" ng-disabled="clntrlBtn">{{action}}</button>
                        <button type="button" class="btn btn-sub" id="sbt" ng-click="checkteest(emailData.email, emailData.password)" ng-disabled="hidethis" ng-if="Add" >Test mail</button>
                        <button type="button" class="btn btn-sub" ng-click="Cancel()" ng-if="cancl">Cancel</button>                        
                    </div>
                      
                </form>
            </div>
        </div>
        
    </div> <!-- Model ends-->

 <!-- Filter Form Start-->
    <div class="wrap-filter-form show-widget" id="slideout">
        <form name="professionFilter" role="form" ng-submit="filterDetails(searchDetails)" class="embed-contact-form">
            <strong>Filter</strong>   
            <button type="button" class="close toggleForm" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button><hr>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Email Account</label>
                        <span class="input-icon icon-right">
                            <input type="text" ng-model="searchDetails.email" name="email" class="form-control">
                        </span>
                    </div>

                </div>
                <!--div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Status</label>
                        <span class="input-icon icon-right">
                            <select name="status" ng-model="searchDetails.status" class="form-control" >
                                <option value="">Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <i class="fa fa-sort-desc"></i>
                        </span>
                    </div>
                </div-->
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

<script>
    $(document).ready(function(){
        $("#sbt").click(function(e){
            if( $(".select2-input").attr('placeholder') === '' && $(".department").hasClass("ng-hide")) {}
            else{ $(".department").removeClass("ng-hide");}   
        });
    });
    
        $("#passToggle").click(function(){
            $('#password').attr('type', 'text');
            myFunction();
        });

        function myFunction() {
            setTimeout(function(){            
                $('#password').attr('type', 'password');
            }, 3000);
        }
    
</script>

<!--Beyond Scripts-->
<!--script src="assets/js/beyond.min.js"></script-->
