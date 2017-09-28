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
<div class="row" ng-controller="cloudtelephonyController" ng-init="teamoutboundLists([[$loggedInUserId]], 1, [[config('global.recordsPerPage')]])">
    <div class="col-xs-12 col-md-12">
        <div class="widget flat radius-bordered">
            <div class="widget-header bordered-bottom bordered-themeprimary">
                <span class="widget-caption">Team Outbound Logs</span>
            </div>
            <div class="widget-body table-responsive">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="search">Records per page:</label>
                            <span class="input-icon icon-right">
                                <input type="text" minlength="1" maxlength="3" ng-model="itemsPerPage" ng-change="teamoutboundLists([[$loggedInUserId]],{{pageNumber}}, itemsPerPage)" ng-model-options="{ updateOn: 'blur' }" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  class="form-control">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="search"></label>
                            <span class="input-icon icon-right">
                                <button type="button" class="btn btn-primary ng-click-active" style="float: right;margin-left: 10px;" data-toggle="modal" data-target="#showFilterModal" ng-click="procName('proc_team_outboundlogs', 1)">
                                    <i class="btn-label fa fa-filter"></i>Show Filter</button>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="search"></label>
                            <span class="input-icon icon-right">
                                <a href="" class="btn btn-primary" id="downloadExcel" download="{{fileUrl}}"  ng-show="dnExcelSheet">
                                    <i class="btn-label fa fa-file-excel-o"></i>Download excel</a>
                                <a href="javascript:void(0);" id="exportExcel" uploadfile class="btn btn-primary" ng-click="outLogexportReport(teamoutboundList)" ng-show="btnExport">
                                    <i class="btn-label fa fa-file-excel-o"></i>Export to Excel
                                </a> 
                            </span>
                        </div>
                    </div> 
                    <div class="col-sm-6 col-xs-12 dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginate">
                        <div class="form-group">
                            <label for="search"></label>
                            <span class="input-icon icon-right">
                                <span ng-if="teamoutboundLength" >&nbsp; &nbsp; &nbsp; Showing {{teamoutboundList.length}} Logs Out Of Total {{teamoutboundLength}} Logs&nbsp;</span>
                                <dir-pagination-controls class="pull-right pagination" on-page-change="pageChanged(newPageNumber,'teamoutboundLists', [[$loggedInUserId]])" template-url="/dirPagination"></dir-pagination-controls>
                            </span>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- filter data-->
                <div class="row" style="border:2px;" id="filter-show">
                    <div class="col-sm-12 col-xs-12">
                        <b ng-repeat="(key, value) in showFilterData" ng-if="value != 0 && key != 'toDate'">
                            <div class="col-sm-2" data-toggle="tooltip" title="{{  key.substring(0, key.indexOf('_'))}}"> 
                                <div class="alert alert-info fade in">
                                    <button class="close" ng-click="removeoutboundDataFromFilter('{{ key}}');" data-dismiss="alert"> ×</button>
                                    <strong ng-if="key === 'empId'" ng-repeat='emp in value track by $index'> {{ $index + 1}}){{   emp.first_name}}  {{ emp.last_name}} </strong>
                                    <strong ng-if="key === 'callstatus'"><strong>Call Status : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'customer_number'"><strong>Customer Number : </strong>{{ value}}</strong>
                                    <strong ng-if="key === 'fromDate'"  data-toggle="tooltip" title="Log Date"><strong>Call Date : </strong>{{ showFilterData.fromDate | date:'dd-MMM-yyyy' }} To {{ showFilterData.toDate |date:'dd-MMM-yyyy' }}</strong>
                                </div>
                            </div>
                        </b>                        
                    </div>
                </div>
                <!-- filter data-->
                <br>
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                            <th style="width:5%">Sr. No.</th>
                            <th style="width: 15%">Call Date & Time</th>
                            <th style="width: 10%">Customer Number</th>
                            <th style="width: 10%">Customer Name</th>
                            <th style="width: 10%">Call Status</th>
                            <th style="width: 10%">Call By</th>
                            <th style="width: 10%">Call Duration</th>
                            <th style="width: 10%">Recording</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr dir-paginate="outbound in teamoutboundList | filter:search | itemsPerPage: itemsPerPage " total-items="{{ teamoutboundLength}}">
                            <td>{{ itemsPerPage * (pageNumber - 1) + $index + 1}}</td>  
                            <td>{{ outbound.call_date + ' @ ' + outbound.call_time}}</td>
                            <td>{{ outbound.customer_number}}</td>
                            <td>{{ outbound.customer_name}}</td>
                            <td>{{ outbound.customer_call_status}}</td>
                            <td>{{ outbound.employee_name}}</td>
                            <td>{{ outbound.customer_call_duration}}</td>
                            <td ng-show="{{outbound.customer_call_status == 'Connected'}}"><audio id="teamobjectout_{{ outbound.id}}" controls></audio></td>
                            <td ng-show="{{outbound.customer_call_status != 'Connected'}}">- NA -</td>


                        </tr>
                        <tr>
                            <td colspan="8" ng-if="!teamoutboundLength" align="center">Record Not Found</td>
                        </tr>
                    </tbody>
                </table><br>
                <div class="DTTTFooter" ng-if="teamoutboundLength">
                    <div class="col-sm-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page No. {{pageNumber}}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_bootstrap" id="DataTables_Table_0_paginate">
                            <dir-pagination-controls class="pull-right pagination" on-page-change="pageChanged(newPageNumber,'teamoutboundLists', [[$loggedInUserId]])" template-url="/dirPagination"></dir-pagination-controls>
                        </div>
                    </div>
                </div>
                <div data-ng-include="'/cloudtelephony/showoutboundFilter'"></div>
            </div>
        </div>
    </div>
</div>


