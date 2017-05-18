<div class="row" ng-controller="clientInfoCtrl" ng-init="manageClients()">  
    <div>
          <flash-message duration="5000"></flash-message>
     </div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header col-xs-12 col-md-12">
                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
                
                
         
                <div class=" col-xs-12 col-md-12" style="border-top:1px dotted #ccc;padding-top:10px;">
                <div class="row">    
                    <p style="float:left">
                        Manage Clients 
                    </p>    
                    <p style="float: right">
                           <a href="#/[[config('global.getUrl')]]/clients/create" title="Create New Client" class="btn btn-info">Create New Client</a>&nbsp;&nbsp;&nbsp;
                    </p>
                </div>
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
                      <input type="number" min="1" max="50" style="width:25%;" class="form-control" ng-model="itemsPerPage">
                    </div>
                </div><br>
                <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                            <tr>
                            <th style="width:2%">
                                <a href="javascript:void(0);" ng-click="orderByField ='id'; reverseSort = !reverseSort">SR. No.
                                  <span ng-show="orderByField == 'id'">
                                  <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                                </a>
                            </th>  
                             <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'client_id'; reverseSort = !reverseSort">Client Id
                                    <span ng-show="orderByField == 'client_id'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'group_name'; reverseSort = !reverseSort">Client Groups
                                    <span ng-show="orderByField == 'group_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'marketing_name'; reverseSort = !reverseSort">Marketing Name
                                    <span ng-show="orderByField == 'marketing_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>                            
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'legal_name'; reverseSort = !reverseSort">Legal Name
                                    <span ng-show="orderByField == 'legal_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            <th style="width: 15%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'website'; reverseSort = !reverseSort">URL
                                    <span ng-show="orderByField == 'website'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            
                            <th style="width: 2%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in clientInfoList| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                            <td>{{ itemsPerPage * (noOfRows-1)+$index+1 }}</td>
                            <td>{{ list.client_id}}</td> 
                            <td>{{ list.getclient_groups.group_name}}</td> 
                            <td>{{ list.marketing_name}}</td> 
                            <td>{{ list.legal_name}}</td> 
                            <td>{{ list.website}}</td> 
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#clientGroupsModal"><a href="#/[[config('global.getUrl')]]/clients/update/{{ list.id }}"><i class="fa fa-pencil"></i></a></div>
                            </td>
                        </tr>
                        <tr ng-if='totalrecords == 0'>
                            <td colspan='7' align='center'>- No Records Found -</td>
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
    
</div>

