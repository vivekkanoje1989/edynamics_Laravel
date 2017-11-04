<style>
    .actions {
        z-index: 0 !important;
    }
    .help-block {
        margin-top: 0px !important; 
        margin-bottom: 0px !important; 
        color: #e46f61;
    }
    textarea {
        resize: none;
    }
</style>
<div ng-controller="taskManagement">
	<div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style="position: relative; top: -98px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="getProducts(); getsubProducts(); getpmodules(); getsubmodules(); getDeveloper();getTester(); getSupportEmp(); getTmStatus(); getTmPriority(); vbreadcumbs = [
				{'displayName': 'Home', 'url': 'goDashboard()'},
				{'displayName': 'Task Management', 'url': 'gotasklist()'},
				{'displayName': 'Task List', 'url': 'gotasklist()'},
				{'displayName': 'Add Task', 'url': ''}
			]">
		<ol class="breadcrumb" >
			<i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
			<li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
			</li>
		</ol>
	</div>
	<input type="hidden" ng-model="taskForm.csrfToken" name="csrftoken" id="csrftoken" ng-init="taskForm.csrfToken = '<?php echo csrf_token(); ?>'"  class="form-control">
	<input type="hidden" ng-model="taskData.id" name="id" id="empId" ng-init="taskForm.id = '[[ $empId ]]'" value="[[ $empId ]]" class="form-control">
	<div class="row" >
		<input type="hidden" name="employeeId" id="employeeId"  value="[[$empId]]" >
		<div class="col-lg-12 col-sm-12 col-xs-12"  >
			<h5 class="row-title before-themeprimary"><i class="fa fa-chevron-left themeprimary" title="Go Back" style="cursor: pointer;border-right: 1px solid;padding-right: 11px;" ng-click="backpage()">  Back</i><i class="fa  fa-arrow-circle-o-right themeprimary"></i> Add Task</h5>
			<div id="WiredWizard" class="wizard wizard-wired" data-target="#WiredWizardsteps">
				<ul class="steps">
					<li  class="wiredstep1 active" ng-click="goprevious(1)"><span class="step">1</span><span class="title">Product</span><span class="chevron"></span></li>
					<li  class="wiredstep2" ng-click="goprevious(2)"><span class="step btn-nxt1">2</span><span class="title">Assign TO</span> <span class="chevron"></span></li>
					<li  class="wiredstep3" ng-click="goprevious(3)"><span class="step btn-nxt2">3</span><span class="title">Task Details</span> <span class="chevron"></span></li>
					<li  class="wiredstep4" ng-click="goprevious(4)"><span class="step btn-nxt3">4</span><span class="title">status</span> <span class="chevron"></span></li>
				</ul>

				<!--ul class="steps">
					<li   ng-click="getStepDiv(1, steps, 1, steps.first_name)" id="step1" ng-class="{'complete':steps.first_name == 1}" class="user_steps wiredstep1"><span class="step">1</span><span class="title">Product</span><span class="chevron"></span></li>
					<li   ng-click="getStepDiv(2, steps, 1, steps.personal_email1)" id="step2" ng-class="{'complete':steps.personal_email1 == 1}" class="user_steps wiredstep2"><span class="step btn-nxt1">2</span><span class="title">Assign TO</span> <span class="chevron"></span></li>
					<li   ng-click="getStepDiv(3, steps, 1, steps.highest_education_id)" id="step3" ng-class="{'complete':steps.highest_education_id == 1}" class="user_steps wiredstep3"><span class="step btn-nxt2">3</span></span><span class="title">Task Details</span> <span class="chevron"></span></li>
					<li   ng-click="getStepDiv(4, steps, 1, steps.deptId)" ng-class="{'complete':steps.deptId == 1}" id="step4" class="user_steps wiredstep4"><span class="step btn-nxt3">4</span><span class="title">Job Offer Details</span> <span class="chevron"></span></li>
				</ul-->
			</div>
			<div class="step-content" id="WiredWizardsteps"  >
				<div class="step-pane active" id="wiredstep1" >
					<form name="taskForm" novalidate ng-submit="taskForm.$valid && createTask(taskData, [[ $empId ]])" >
						<input type="hidden" name="employeeId" ng-model="employeeId" value="{{employeeId}}" >
						<div class="form-title">Product Information</div>
						<div class="row">
							<div class="col-sm-3 col-xs-6">
								<div class="form-group" ng-class="{ 'has-error' : step1 && (!taskForm.product_id.$dirty && taskForm.product_id.$invalid)}">
									<label for="">Product <span class="sp-err">*</span></label>
									<span class="input-icon icon-right">
										<select ng-model="taskData.product_id" name="product_id" ng-change="pchange(taskData.product_id)" class="form-control" required="required">
											<option value="">Select Product</option>
											<option ng-repeat="p in productRow track by $index" value="{{p.id}}" ng-selected="{{ p.id == taskData.product_id}}">{{p.product_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step1" ng-messages="taskForm.product_id.$error" class="help-block step1">
											<div ng-message="required">This field is required.</div>
										</div>
									</span>
								</div>
							</div>

							<div class="col-sm-3 col-xs-6">
								<div class="form-group" ng-class="{ 'has-error' : step1 && (!taskForm.sub_product_id.$dirty && taskForm.sub_product_id.$invalid)}">
									<label for="">Sub Product <span class="sp-err">*</span></label>
									<span class="input-icon icon-right">
										<select ng-model="taskData.sub_product_id" name="sub_product_id" ng-change="spchange(taskData.sub_product_id)" class="form-control" required>
											<option value="">Select Sub Product</option>
											<option ng-repeat="sbp in subproductRow track by $index | filter:searchP" value="{{sbp.id}}" ng-selected="{{ sbp.id == taskData.sub_product_id}}">{{sbp.sub_product_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step1" ng-messages="taskForm.sub_product_id.$error" class="help-block step1">
											<div ng-message="required">This field is required.</div>
										</div>
									</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="form-group" ng-class="{ 'has-error' : step1 && (!taskForm.modules_id.$dirty && taskForm.modules_id.$invalid)}">
									<label for="">Module  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskData.modules_id" name="modules_id" ng-change="mchange(taskData.modules_id)" class="form-control"   placeholder="Select Module"   required>
											<option value="">Select Module</option>
											<option ng-repeat="m in moduleRow track by $index | filter:searchM" value="{{m.id}}" ng-selected="{{ m.id == taskData.modules_id}}">{{m.module_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step1" ng-messages="taskForm.modules_id.$error" class="help-block step1">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>
							</div>

							<div class="col-sm-3 col-xs-6">
								<div class="form-group" ng-class="{ 'has-error' : step1 && (!taskForm.sub_modules_id.$dirty && taskForm.sub_modules_id.$invalid)}">
									<label for="">Sub Module  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskData.sub_modules_id" name="sub_modules_id" class="form-control"   placeholder="Select Sub Module"   required>
											<option value="">Select Sub Module</option>
											<option ng-repeat="sbm in submoduleRow track by $index | filter:searchsbM" value="{{sbm.id}}" ng-selected="{{ sbm.id == taskData.sub_modules_id}}">{{sbm.sub_module_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step1" ng-messages="taskForm.sub_modules_id.$error" class="help-block step1">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>
							</div>         
						</div><br><br>  
						
						<div class="row">
							<div class="col-md-12 col-xs-12" align="right">
								<button type="submit" class="btn btn-primary btn-nxt1"  ng-click="step1 = true; getStepDiv(1, [[$empId]])"  >Next</button>
							</div>
						</div>
					</form>
				</div>	
				<div class="step-pane" id="wiredstep2" >	
					<form name="tasktwoForm" novalidate ng-submit="tasktwoForm.$valid && assign && createAssignto(tasktwoData, [[$empId]])"   >
						<div class="form-title">Task Assign To</div>
						<div class="row">
							<div class="col-sm-4 ">
								<div class="form-group" ng-class="{ 'has-error' : step2 && (!tasktwoForm.developer_employee_id.$dirty && tasktwoForm.developer_employee_id.$invalid)}">
									<label for="">Developer <span class="sp-err">*</span></label>
									<span class="input-icon icon-right">
										<select ng-model="tasktwoData.developer_employee_id" name="developer_employee_id" class="form-control" required="required">
											<option value="">Select Developer</option>
											<option ng-repeat="p in developerList track by $index " value="{{p.employee_id}}" ng-selected="{{ p.employee_id == tasktwoData.developer_employee_id}}">{{p.dispay_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step2" ng-messages="tasktwoForm.developer_employee_id.$error" class="help-block step2">
											<div ng-message="required">This field is required.</div>
										</div>
									</span>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group" ng-class="{ 'has-error' : step2 && (!tasktwoForm.tester_employee_id.$dirty && tasktwoForm.tester_employee_id.$invalid)}">
									<label for="">Tester <span class="sp-err">*</span></label>
									<span class="input-icon icon-right">
										<select ng-model="tasktwoData.tester_employee_id" name="tester_employee_id" class="form-control" required>
											<option value="">Select Tester</option>
											<option ng-repeat="sbp in testerList track by $index | filter:searchP" value="{{sbp.employee_id}}" ng-selected="{{ sbp.employee_id == tasktwoData.tester_employee_id}}">{{sbp.dispay_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step2" ng-messages="tasktwoForm.tester_employee_id.$error" class="help-block step2">
											<div ng-message="required">This field is required.</div>
										</div>
									</span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group" ng-class="{ 'has-error' : step2 && (!tasktwoForm.support_employee_id.$dirty && tasktwoForm.support_employee_id.$invalid)}">
									<label for="">Support  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="tasktwoData.support_employee_id" name="support_employee_id" class="form-control" required>
											<option value="">Select Support</option>
											<option ng-repeat="m in SupportEmpRow track by $index | filter:searchM" value="{{m.employee_id}}" ng-selected="{{ m.employee_id == tasktwoData.support_employee_id}}">{{m.dispay_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step2" ng-messages="tasktwoForm.support_employee_id.$error" class="help-block step2">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>
							</div>							         
						</div><br><br> 
							
						<div class="row">
							<div class="col-md-12 col-xs-12" align="right">
								<button type="button" class="btn btn-primary btn-pre2" ng-click="previous(1, 2)">Prev</button>
								<button type="submit" class="btn btn-primary btn-nxt2" ng-click="step2 = true;">Next</button>
							</div>
						</div>
					</form>
				</div>
				<div class="step-pane" id="wiredstep3" >
					<form name="taskthreeForm" novalidate ng-submit="taskthreeForm.$valid && createTaskdetails(taskthreeData, taskthreeData.employee_photo_file_name, [[ $empId ]]);" enctype="multipart/form-data">
						<div class="form-title">
							Task Details
						</div>
						<div class="row">							

							<div class="col-sm-6 col-xs-9">
                                <div class="form-group" ng-class="{ 'has-error' : step3 && (!taskthreeForm.task_details.$dirty && taskthreeForm.task_details.$invalid)}">
                                    <label for="">Task Details <span class="sp-err">*</span></label>
                                    <span class="input-icon icon-right">
                                        <textarea ng-model="taskthreeData.task_details" name="task_details" class="form-control" maxlength="255" required></textarea>
                                        <i class="fa fa-tasks"></i>
                                        <div ng-show="step3" ng-messages="taskthreeForm.task_details.$error" class="help-block step3">
                                            <div ng-message="required">This field is required.</div>
                                        </div>
                                    </span>
                                </div>
                            </div>

							<div class="col-sm-6 col-xs-9">
								<label for="">Screenshot ( W 105 X H 120 )</label>
								<span class="input-icon icon-right">
									<input type="file" style="height: 47px;padding-top: 12px;" ngf-select ng-model="taskthreeData.employee_photo_file_name" value="Select photo" ng-change="checkImageExtension(taskthreeData.employee_photo_file_name)" name="employee_photo_file_name"   ng-model-options="{ allowInvalid: true, debounce: 300 }"  id="employee_photo_file_name" accept="image/*" ngf-max-size="2MB" class="form-control imageFile"  ngf-model-invalid="errorFile" accept="image/x-png,image/gif,image/jpeg,image/bmp" >
									<div ng-show="step3 || invalidImage" ng-messages="taskthreeData.employee_photo_file_name.$error" class="help-block step3">
										<div ng-if="invalidImage">{{invalidImage}}</div>
									</div>
									<img ng-src="{{image_source}}" class="thumb photoPreview"> 
								</span> 
								<div class="img-div2" data-title="name" ng-repeat="list in employee_photo_file_name_preview">    
									<img ng-src="{{list}}" class="thumb photoPreview">
								</div>
							</div>

						</div>

						<br><br>
						<div class="row">	
							<div class="col-sm-3 col-xs-6">
								<label>Issued Date <span class="sp-err">*</span></label>
								<div class="form-group" ng-class="{ 'has-error' : step3 && (!taskthreeForm.issued_date.$dirty && taskthreeForm.issued_date.$invalid)}">
									<p class="input-group" ng-controller="DatepickerDemoCtrl">
										<input type="text" ng-model="taskthreeData.issued_date" name="issued_date"  id="issued_date" max-date="maxDates" class="form-control" datepicker-popup="{{format}}" is-open="opened"  datepicker-options="dateOptions" close-text="Close" readonly required/>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default" ng-click="open($event, 3)" show-button-bar="false"><i class="glyphicon glyphicon-calendar"></i></button>
										</span>
									</p>
									<div ng-show="step3" ng-messages="taskthreeForm.issued_date.$error" class="help-block step3">
										<div ng-message="required">This field is required.</div>
									</div>
								</div>
							</div>

							<div class="col-sm-3 col-xs-6">
								<label>Estimated Date <span class="sp-err">*</span></label>
								<div  class="form-group" ng-class="{ 'has-error' : step3 && (!taskthreeForm.estimated_date.$dirty && taskthreeForm.estimated_date.$invalid)}">
									<p class="input-group" ng-controller="DatepickerDemoCtrl">
										<input type="text" ng-model="taskthreeData.estimated_date" name="estimated_date"  id="estimated_date" max-date="maxDates" class="form-control" datepicker-popup="{{format}}" is-open="opened"  datepicker-options="dateOptions" close-text="Close" readonly required/>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default" ng-click="open($event, 4)" show-button-bar="false"><i class="glyphicon glyphicon-calendar"></i></button>
										</span>
									</p>
									<div ng-show="step3" ng-messages="taskthreeForm.estimated_date.$error" class="help-block step3">
										<div ng-message="required">This field is required.</div>
									</div>
								</div>
							</div>                         
						
							<div class="col-sm-3 col-xs-6">								
								<div class="form-group" ng-class="{ 'has-error' : step3 && (!taskthreeForm.task_priority.$dirty && taskthreeForm.task_priority.$invalid)}">
									<label for="">Task Priority  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskthreeData.task_priority" name="task_priority" class="form-control" required>
											<option value="">Select Priority</option>
											<option ng-repeat="priot in tmPriorityRow track by $index " value="{{priot.id}}" ng-selected="{{ priot.id == taskthreeData.task_priority}}">{{priot.priority_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step3" ng-messages="taskthreeForm.task_priority.$error" class="help-block step3">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>						
							</div>

							<div class="col-sm-3 col-xs-6">
                                <div class="form-group" >
                                    <label for="">Task Note </label>
                                    <span class="input-icon icon-right">
                                        <input ng-model="taskthreeData.task_note" name="task_note" class="form-control" placeholder="Note if any..." required>
                                        <i class="fa fa-sticky-note"></i>                                        
                                    </span>
                                </div>
                            </div>					

						</div>
						<br><br>
						<div class="row">
							<div class="col-md-12 col-xs-12" align="right">
								<button type="button" class="btn btn-primary btn-pre3" ng-click="previous(2, 3)">Prev</button>
								<button type="submit" class="btn btn-primary btn-nxt3"  ng-click="step3 = true;" >Next</button>
							</div>
						</div>
					</form> 
				</div>	
				
				<div class="step-pane" id="wiredstep4" >
					<form name="taskfourForm" novalidate ng-submit="taskfourForm.$valid && createStatus(taskfourData, [[ $empId ]])"  >
						<div class="form-title">                                           
							Task status
						</div>
						<div class="row">

							<div class="col-sm-3 col-xs-6">								
								<div class="form-group" ng-class="{ 'has-error' : step4 && (!taskfourForm.developer_task_status.$dirty && taskfourForm.developer_task_status.$invalid)}">
									<label for="">Developer Task Status  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskfourData.developer_task_status" name="developer_task_status" class="form-control" required>
											<option value="">Select Status</option>
											<option ng-repeat="dst in tmStatusRow track by $index" value="{{dst.id}}" ng-selected="{{ dst.id == taskfourData.developer_task_status}}">{{dst.status_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step4" ng-messages="taskfourForm.developer_task_status.$error" class="help-block step3">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>						
							</div>

							<div class="col-sm-3 col-xs-6">								
								<div class="form-group" ng-class="{ 'has-error' : step4 && (!taskfourForm.tester_task_status.$dirty && taskfourForm.tester_task_status.$invalid)}">
									<label for="">Tester Task Status  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskfourData.tester_task_status" name="tester_task_status" class="form-control" required>
											<option value="">Select Status</option>
											<option ng-repeat="trsts in tmStatusRow track by $index" value="{{trsts.id}}" ng-selected="{{ trsts.id == taskfourData.tester_task_status }}">{{trsts.status_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step4" ng-messages="taskfourForm.tester_task_status.$error" class="help-block step3">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>						
							</div>

							<div class="col-sm-3 col-xs-6">								
								<div class="form-group" ng-class="{ 'has-error' : step4 && (!taskfourForm.support_task_status.$dirty && taskfourForm.support_task_status.$invalid)}">
									<label for="">Support Task Status  <span class="sp-err">*</span></label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskfourData.support_task_status" name="support_task_status" class="form-control" required>
											<option value="">Select Status</option>
											<option ng-repeat="sppsts in tmStatusRow track by $index" value="{{sppsts.id}}" ng-selected="{{ sppsts.id == taskfourData.support_task_status}}">{{sppsts.status_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step4" ng-messages="taskfourForm.support_task_status.$error" class="help-block step4">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>						
							</div>
						</div>

						<div class="row">

							<div class="col-sm-3 col-xs-6">								
								<div class="form-group" ng-class="{ 'has-error' : step4 && (!taskfourForm.task_status.$dirty && taskfourForm.task_status.$invalid)}">
									<label for="">Completion Task Status </label>
									<span class="input-icon icon-right" required>
										<select ng-model="taskfourData.task_status" name="task_status" class="form-control" required>
											<option value="">Select Status</option>
											<option ng-repeat="cmpsts in tmStatusRow track by $index" value="{{cmpsts.id}}" ng-selected="{{ cmpsts.id == taskfourData.task_status}}">{{cmpsts.status_name}}</option>
										</select>
										<i class="fa fa-sort-desc"></i>
										<div ng-show="step4" ng-messages="taskfourForm.task_status.$error" class="help-block step4">
											<div ng-message="required">This field is required.</div>
										</div>                                
									</span>
								</div>						
							</div>

							<div class="col-sm-3 col-xs-6">
								<label>Completion Date </label>
								<div ng-controller="DatepickerDemoCtrl" class="form-group">
									<p class="input-group">
										<input type="text" ng-model="taskfourData.completion_date" name="completion_date"  id="completion_date" max-date="maxDates" class="form-control" datepicker-popup="{{format}}" is-open="opened"  datepicker-options="dateOptions" close-text="Close" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-default" ng-click="open($event, 5)" show-button-bar="false"><i class="glyphicon glyphicon-calendar"></i></button>
										</span>
									</p>
								</div>
							</div>			


							<div class="col-sm-3 col-xs-6">
								<div class="form-group" >
									<label>Remark </label>
									<span class="input-icon icon-right">
										<input ng-model="taskfourData.remark" name="remark" class="form-control" >
										<i class="fa fa-comment-o"></i>
									</span>
								</div>
							</div>							
							
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12" align="right">
								<span class="progress" ng-show="taskthreeData.employee_photo_file_name.progress >= 0">
									<div style="width:{{taskthreeData.employee_photo_file_name.progress}}%" ng-bind="taskthreeData.employee_photo_file_name.progress + '%'"></div>
								</span>
								<span ng-show="taskthreeData.employee_photo_file_name.result">Upload Successful</span>
								<button type="button" class="btn btn-primary btn-pre3" ng-click="previous(3, 4)">Prev</button>
								<button type="submit" class="btn btn-primary btn-submit-last"  ng-click="step4 = true; " >Create</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<script>
    /*  $(document).ready(function(){
     $(".btn-nxt1").mouseup(function(e){
     if ($(".step1").hasClass("ng-active")) {
     e.preventDefault();
     } else{
     $("#wiredstep1").hide();
     $("#wiredstep2").show();
     $(".wiredstep2").addClass("active");
     $(".wiredstep1").removeClass("active");
     $(".wiredstep1").addClass("complete");
     }
     });
     $(".btn-nxt2").click(function(e){
     if ($(".step2").hasClass("ng-active")) {
     e.preventDefault();
     } else{
     $("#wiredstep2").hide();
     $("#wiredstep3").show();
     $(".wiredstep3").addClass("active");
     $(".wiredstep2").removeClass("active");
     $(".wiredstep2").addClass("complete");
     }
     });
     $(".btn-nxt3").click(function(e){
     if ($(".step3").hasClass("ng-active")) {
     e.preventDefault();
     } else{
     $("#wiredstep3").hide();
     $("#wiredstep4").show();
     $(".wiredstep4").addClass("active");
     $(".wiredstep3").removeClass("active");
     $(".wiredstep3").addClass("complete");
     }
     });
     $(".btn-nxt6").click(function(e){
     if ($(".step4").hasClass("ng-active")) {
     e.preventDefault();
     } else{
     $("#wiredstep4").hide();
     $("#wiredstep5").show();
     $(".wiredstep5").addClass("active");
     $(".wiredstep4").removeClass("active");
     $(".wiredstep4").addClass("complete");
     }
     if ($(".select2-input").attr('placeholder') === '' && $(".step4").hasClass("ng-hide")) {
     }
     else{ $(".department").removeClass("ng-hide"); }
     });
     $(".btn-submit-last").click(function(e){
     if ($(".step5").hasClass("ng-active")) {
     e.preventDefault();
     }
     });
     $(".btn-pre2").click(function(){
     $("#wiredstep1").show();
     $("#wiredstep2").hide();
     $(".wiredstep1").addClass("active");
     $(".wiredstep2").removeClass("active");
     $(".wiredstep1").removeClass("complete");
     });
     $(".btn-pre3").click(function(){
     $("#wiredstep2").show();
     $("#wiredstep3").hide();
     $(".wiredstep2").addClass("active");
     $(".wiredstep3").removeClass("active");
     $(".wiredstep2").removeClass("complete");
     });
     $(".btn-pre4").click(function(){
     $("#wiredstep3").show();
     $("#wiredstep4").hide();
     $(".wiredstep3").addClass("active");
     $(".wiredstep4").removeClass("active");
     $(".wiredstep3").removeClass("complete");
     });
     $(".btn-pre5").click(function(){
     $("#wiredstep4").show();
     $("#wiredstep5").hide();
     $(".wiredstep4").addClass("active");
     $(".wiredstep5").removeClass("active");
     $(".wiredstep4").removeClass("complete");
     });
     });
     */
    $("#personal_mobile1_calling_code,#personal_mobile2_calling_code,#personal_landline_calling_code,#office_mobile_calling_code").intlTelInput();</script>
	</script>
	<script>
		window.onbeforeunload = confirmExit;
		function confirmExit() {
			return "You have attempted to leave this page. Are you sure?";
		}
	</script>