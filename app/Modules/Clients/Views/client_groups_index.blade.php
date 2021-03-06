<div class="row" ng-controller="clientGroupCtrl" ng-init="manageClientGroups()">  
    <div>
          <flash-message duration="5000"></flash-message>
     </div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header col-xs-12 col-md-12">                
               
         
                <div class=" col-xs-12 col-md-12" style="border-top:1px dotted #ccc;padding-top:10px;">
                <div class="row">    
                    <p style="float:left">
                        Manage Client Groups
                    </p>    
                    <p style="float: right">
                           <a href="" data-toggle="modal" data-target="#clientGroupsModal" ng-click="initialModal(0,'','')" class="btn btn-info">Create</a>&nbsp;&nbsp;&nbsp;
                    </p>
                </div>
                </div>
               </div>
                            
            
            <div class="widget-body table-responsive">  
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                      <label for="search">Search:</label>
                      <input type="text" ng-model="search" class="form-control" style="width:25%;"  placeholder="Search">
                    </div>

                    <div class="col-sm-6 col-xs-12">
                      <label for="search">Records per page:</label>
                      <input type="text" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   minlength="1" maxlength="3" style="width:25%;" class="form-control" ng-model="itemsPerPage">
                    </div>
                </div><br>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                            <tr>
                            <th style="width:5%">
                                <a href="javascript:void(0);" ng-click="orderByField ='id'; reverseSort = !reverseSort">Sr. No.
                                  <span ng-show="orderByField == 'id'">
                                  <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                                </a>
                            </th>                       
                            <th style="width: 30%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'group_name'; reverseSort = !reverseSort">Client Groups
                                    <span ng-show="orderByField == 'group_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>                            
                            <th style="width: 5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in clientgroupslist| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                            <td>{{ itemsPerPage * (noOfRows-1)+$index+1 }}</td>
                            <td>{{ list.group_name}}</td>                          
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#clientGroupsModal"><a href="javascript:void(0);" ng-click="initialModal({{ list.id}},'{{list.group_name}}',$index)"><i class="fa fa-pencil"></i></a></div>
                            </td>
                        </tr>
                        <tr ng-if='totalrecords == 0'>
                            <td colspan='2' ng-show="(clientgroupslist|filter:search).length==0" align='center'>No Records Found</td>
                        </tr>
                    </tbody>
                </table>
                </div>    
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
    
    
     <!-- Modal -->
    <div class="modal fade" id="clientGroupsModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>
                
                <form ng-submit="clientGroupForm.$valid && processClientGroups()" name="clientGroupForm"  novalidate>
                    <div class="modal-body">
                        <div class="form-group" ng-class="{ 'has-error' : btnClientGroup && display_msg && (!clientGroupForm.group_name.$dirty && bloodGroupForm.group_name.$invalid)}">
                            
                            <input type="hidden" class="form-control" ng-model="id" name="id">
                            
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="group_name" name="group_name" maxlength="25"  oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')" placeholder="Client group" ng-change="errorMsg = null" required>
                                <i class="fa fa-users thm-color circular"></i>
                                <div class="help-block" ng-show="btnClientGroup" ng-if="display_msg" ng-messages="clientGroupForm.group_name.$error">
                                    <div ng-message="required" class="sp-err">Client group cannot be blank.</div>
                                    <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>
                                </div>
                            </span>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-primary" ng-click="btnClientGroup = true;display_msg=true">Submit</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>

    
</div>
