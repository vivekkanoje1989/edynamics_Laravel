<style>
    .btn-round{
        border-radius: 50%;
        height: 40px;
        width: 40px;
        line-height: 28px;
        padding-left: 13px;
        outline: none !important;
    }
    @media (min-width:768px){
        .modal-dialog {
            width: 700px !important;
        }
    }
    .editor-text {
        border: 1px solid #cecece;
        margin-top: 10px;
        background-color: #fff;
        padding: 10px;
    }
</style>
<!--Page Related styles-->
<link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />
<div class="row">
    <div class="widget flat radius-bordered ">
        <div class="col-lg-12 col-sm-12 col-xs-12" ng-controller="employeeSalaryslipController"  >
            <div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style="position: fixed; top: 44px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="vbreadcumbs = [
                {'displayName': 'Home', 'url': 'goDashboard()'},
                {'displayName': 'Hr', 'url': 'goSalaryslip()'},
                {'displayName': 'Salary Management', 'url': 'goSalaryslip()'},
                {'displayName': 'Salary Slip', 'url': 'goSalaryslip()'}
            ]">
            <ol class="breadcrumb" >
                <i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
                <li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="javascript:void(0)" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
                </li>
            </ol>
        </div>
            <h5 class="row-title before-themeprimary"><i class="fa  fa-arrow-circle-o-right themeprimary"></i>Employee Salary Slip</h5>
            <div class="widget-body bordered-top bordered-themeprimary col-lg-12 col-sm-12 col-xs-12">
                <span class="widget-caption pull-right "><a class="themeprimary" data-toggle="modal" title="Help Info" data-target="#help"><i class="fa fa-question-circle" aria-hidden="true" style="font-size: 25px;margin-right: 15px; margin-top: 6px;"></i></a></span>

                <div id="user-form">
                    <!--form role="form" name="salryslipForm" method="post"  ng-submit="salryslipForm.$valid && uploadSalaryslip(fileData)"   novalidate enctype="multipart/form-data" -->
                    <form role="form" name="salryslipForm" method="post" enctype="multipart/form-data" ng-submit="uploadFiles(fileData)"> <!--action="http://localhost:8000/employeeSalaryslip/uploadzip"-->
                        <input type="hidden" ng-model="fileData.csrfToken" name="csrftoken" id="csrftoken" ng-init="fileData.csrfToken = '[[ csrf_token() ]]'">
                       
                        <div class="row col-lg-12 col-sm-12 col-xs-12">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="salaryslip">Upload salary slips</label>
                                            <span class="input-icon icon-right">                                    
                                                <select class="form-control" ng-model="salaryslip" name="salaryslip" ng-change="permissionzip(salaryslip)">
                                                    <option value="Choose" ng-selected="true">Choose</option>
                                                    <option value="Bulk">Bulk</option>
                                                    <option value="Individual">Individual</option>
                                                </select>
                                                <i class="fa fa-sort-desc"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="row col-lg-12 col-sm-12 col-xs-12" ng-if="showDiv == 'Bulk'">                            
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-title">
                                    Upload Salary Slip zip
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <input type="hidden" ng-model="id" >
                                <div class="row">                                                                 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Choose zip file</label>
                                            <span class="input-icon icon-right">
                                                <!--input type="file" ngf-select="check(fileData)" ng-model="fileData.zip_file" name="zip_file" id="zip_file"  ngf-pattern="application/zip" accept="application/zip" ngf-max-size="10MB" class="form-control" ><br/-->
                                                <!--input type="file" ng-model="fileData.upfile" name="zip_file" id="zip_file"  ngf-pattern="application/zip" accept="application/zip" ngf-max-size="10MB" class="form-control" ><br/-->
                                                <input type="file" id="file1" name="zip_file" multiple ng-files="getTheFiles($files)" ngf-pattern="application/zip" accept="application/zip" ngf-max-size="10MB" class="form-control" ><br/>
                                                <!--input type="file" id="file1" name="zip_file" multiple ng-files="getTheFiles($files)" /-->
                                            </span>
                                        </div>    
                                    </div>                                  

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Month</label>
                                            <span class="input-icon icon-right">
                                                <select class="form-control" ng-model="fileData.month" name="month" >                                                                                                       
                                                    <option value="{{value}}" ng-repeat="(key, value) in monthdrpdn" ng-selected="{{$index == crntmnth}}">{{value}}</option>                                                    
                                                </select>
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </span>
                                        </div>    
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Year</label>
                                            <span class="input-icon icon-right">
                                               <input type="text" id="year" name="year" ng-model="fileData.year" class="form-control" readonly><br/>
                                            </span>
                                        </div>    
                                    </div>                                  

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Remark</label>
                                            <span class="input-icon icon-right">
                                               <input type="text" id="remark" name="remark" ng-model="fileData.remark" class="form-control" ><br/>
                                            </span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-md-12" align="left">
                                        <button type="submit" class="btn btn-primary" title="Upload" >Upload</button>
                                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 19px;" ng-show="vloader"></i>
                                    </div>
                                </div><br><br>
                                <span class="err">* The zip file should be as Ex: salaryslip_27_09_17.zip (salaryslip_day_month_year.zip)</span><br>
                                <span class="err">* And the files inside zip file should be as Ex: 41_salaryslip_29_09_2017.pdf (employeeId_salaryslip_day_month_year.pdf)</span><br>
                                <span class="err">* EmployeeId can be found at HR / List Employee / Edit Employee / Employee status </span>
                            </div>   
                        </div> 

                        <!-- Upload Individual Salary Slip-->
                        <div class="row col-lg-12 col-sm-12 col-xs-12" ng-if="showDiv == 'Individual'">                            
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-title">
                                    Upload Individual Salary Slip
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <input type="hidden" ng-model="id" >
                                <div class="row">                                                                 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Choose pdf file</label>
                                            <span class="input-icon icon-right">
                                                <!--input type="file" ngf-select="check(fileData)" ng-model="fileData.zip_file" name="zip_file" id="zip_file"  ngf-pattern="application/zip" accept="application/zip" ngf-max-size="10MB" class="form-control" ><br/-->
                                                <!--input type="file" ng-model="fileData.upfile" name="zip_file" id="zip_file"  ngf-pattern="application/zip" accept="application/zip" ngf-max-size="10MB" class="form-control" ><br/-->
                                                <input type="file" id="file1" name="pdf_file" multiple ng-files="getTheFiles($files)" ngf-pattern="application/pdf" accept="application/pdf" ngf-max-size="10MB" class="form-control" ><br/>
                                                <!--input type="file" id="file1" name="zip_file" multiple ng-files="getTheFiles($files)" /-->
                                            </span>
                                        </div>    
                                    </div>                                  

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Month</label>
                                            <span class="input-icon icon-right">
                                                <select class="form-control" ng-model="fileData.month" name="month" >                                                                                                       
                                                    <option value="{{value}}" ng-repeat="(key, value) in monthdrpdn" ng-selected="{{$index == crntmnth}}">{{value}}</option>                                                    
                                                </select>
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </span>
                                        </div>    
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Year</label>
                                            <span class="input-icon icon-right">
                                               <input type="text" id="year" name="year" ng-model="fileData.year" class="form-control" readonly><br/>
                                            </span>
                                        </div>    
                                    </div>                                  

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Remark</label>
                                            <span class="input-icon icon-right">
                                               <input type="text" id="remark" name="remark" ng-model="fileData.remark" class="form-control" ><br/>
                                            </span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-md-12" align="left">
                                        <button type="submit" class="btn btn-primary" title="Upload" >Upload</button>
                                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 19px;" ng-show="vloader"></i>
                                    </div>
                                </div><br><br>
                                <span class="err">* pdf file should be as Ex: 41_salaryslip_29_09_2017.pdf (employeeId_salaryslip_day_month_year.pdf)</span><br>
                                <span class="err">* EmployeeId can be found at HR / List Employee / Edit Employee / Employee status </span>
                            </div>   
                        </div> 
                        <!--div class="col-xs-12 col-md-12" ng-if="showDiv">
                            <div class="widget">                                
                                <div class="widget-header">
                                    <span class="widget-caption" style="font-size: 15px;font-weight: 600 !important;">Document List <span id="errContactDetails" class="errMsg"></span></span>
                                </div>
                                <div class="widget-body table-responsive">
                                    <table class="table table-striped table-hover table-bordered dataTable no-footer" at-config="config">
                                        <thead >
                                            <tr role="row" style=" background-color: #eee; background-image: -moz-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: -o-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: linear-gradient(to bottom,#f2f2f2 0,#fafafa 100%); font-size: 12px;">							
                                                <th>Sr. No. </th>
                                                <th class="sorting" ng-click="OrderFunction('Document')">Document name</th>
                                                <th class="sorting" ng-click="OrderFunction('Number')">Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="list in documentRow | orderBy: OrderRec">
                                                <td>{{$index + 1}}</td>
                                               
                                                <td>{{list.document_name}}</td>
                                                <td>{{list.document_number}}</td>
                                                <td class="fa-div">
                                                    <a href="javascript:void(0);" class="btn btn-info btn-xs edit" tooltip-html-unsafe="Edit Document" ng-click="updateDocument({{list}},{{$index}})"><i class="fa fa-edit" style="color: white !important;"></i> Edit</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs delete" tooltip-html-unsafe="Delete Document" ng-click="deleteDocument({{list}},{{$index}})"><i class="fa fa-trash-o" style="color: white !important;"></i> Delete</a>	
                                                </td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div-->
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>

<!--model Help-->
	<div class="modal fade" id="help" role="dialog" tabindex="-1" >    
        <div class="modal-dialog">           
            <div class="modal-content" style="border: 3px solid azure;border-radius: 30px;height: 489px; background: #0e0e0e38;overflow: auto;">
                <div class="modal-header modal-header widget-header bordered-bottom bordered-themeprimary" style="border-radius: 27px; margin-top: 25px; width: 90%;margin-left: 20px;margin-right: 20px;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title" align="center">Salary Slip Help Info</h4>
                </div>                
                <div class="modal-body" style="">
                    <div class="form-group ">
						<div class="form-group col-sm-3">
							<label style="font-family: serif;font-size: 17px;">Salary Slip <span class="sp-err"> : </span></label>
						</div>
						<div class="form-group col-sm-9">
							<p style="font-family: serif;font-size: 17px;">The Salary Slip cab be upload here.<p>
                        </div>				
                    </div> 
					<div class="form-group ">
						<div class="form-group col-sm-3">
							<label style="font-family: serif;font-size: 17px;">Salary Slip <span class="sp-err"> : </span></label>
						</div>
						<div class="form-group col-sm-9">
							<p style="font-family: serif;font-size: 17px;">The Salary Slip cab be upload here.<p>
                        </div>				
                    </div> 					                           
                </div>                       
            </div>
        </div>
    </div>
