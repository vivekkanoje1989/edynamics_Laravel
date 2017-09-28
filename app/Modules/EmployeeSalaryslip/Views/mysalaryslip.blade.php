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
        <div class="col-lg-12 col-sm-12 col-xs-12" ng-controller="employeeSalaryslipController"  ng-init="getMySalaryslips()">
            <h5 class="row-title before-themeprimary"><i class="fa  fa-arrow-circle-o-right themeprimary"></i>My Salary Slip</h5>
            <div class="widget-body bordered-top bordered-themeprimary col-lg-12 col-sm-12 col-xs-12">
                <br>
                <div class="col-xs-12 col-md-12" >
                    <div class="widget">                                
                        <div class="widget-header">
                            <span class="widget-caption" style="font-size: 15px;font-weight: 600 !important;">Salary Slips <span id="errContactDetails" class="errMsg"></span></span>
                        </div>
                        <div class="widget-body table-responsive">
                            <table class="table table-striped table-hover table-bordered dataTable no-footer" at-config="config">
                                <thead >
                                    <tr role="row" style=" background-color: #eee; background-image: -moz-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: -o-linear-gradient(top,#f2f2f2 0,#fafafa 100%); background-image: linear-gradient(to bottom,#f2f2f2 0,#fafafa 100%); font-size: 12px;">							
                                        <th style="width: 70px;">Sr. No. </th>
                                        <th class="sorting" ng-click="OrderFunction('SalarySlip')">Salary Slip</th>
                                        <th class="sorting" ng-click="OrderFunction('Month')">Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="list in myslrslips | orderBy: OrderRec">
                                        <td>{{$index + 1}}</td>                                               
                                        <td>{{list.salaryslip_docName}}</td>
                                        <td>{{list.month}}</td>
                                        <td class="fa-div">
                                            <a href="[[ config('global.s3Path').'/Employee-Salaryslips/']]{{list.salaryslip_docName}}" class="btn btn-success btn-xs" style="width: 85px !important;" tooltip-html-unsafe="Download Salay slip" ng-click=""><i class="fa fa-cloud-download" style="color: white !important; "></i> Download</a>
                                        </td>
                                    </tr>                                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>    
</div>