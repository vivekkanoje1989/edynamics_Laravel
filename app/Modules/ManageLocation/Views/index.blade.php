<div class="row" ng-controller="locationCtrl" ng-init="manageLocation()">  
<div>
          <flash-message duration="5000"></flash-message>
</div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Manage Location</span>
                <a href="" data-toggle="modal" data-target="#LocationModal" ng-click="initialModal(0,'','','','')" class="btn btn-info">Create New Location</a>&nbsp;&nbsp;&nbsp;
                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
            </div>
            <div class="widget-body table-responsive">     
            <div class="row">
                    <div class="col-sm-6 col-xs-12">
                      <label for="search">Search:</label>
                      <input type="text" ng-model="search" class="form-control" style="width:25%;" placeholder="Search">
                    </div>

                    <div class="col-sm-6 col-xs-12">
                      <label for="search">Records per page:</label>
                      <input type="number" min="1" max="50" style="width:25%;" class="form-control" ng-model="itemsPerPage">
                    </div>
                </div><br>           
                <table class="table table-hover table-striped table-bordered" at-config="config">
                    <thead class="bord-bot">
                        <tr>
                            <tr>
                            <th style="width:5%">
                            <a href="javascript:void(0);" ng-click="orderByField ='id'; reverseSort = !reverseSort">SR No.
                              <span ng-show="orderByField == 'id'">
                              <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                            </a></th>                          
                            <th style="width:35%">
                            <a href="javascript:void(0);" ng-click="orderByField ='location_type'; reverseSort = !reverseSort">Location
                              <span ng-show="orderByField == 'location_type'">
                              <span ng-show="!reverSort">^</span><span ng-show="reverseSort">v</span></span>
                            </a></th>
                                                       
                            <th style="width: 5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr role="row" dir-paginate="list in locationRow| filter:search | itemsPerPage:itemsPerPage | orderBy:orderByField:reverseSort" >
                            <td>{{itemsPerPage * (noOfRows-1)+$index+1}}</td>
                            <td>{{list.location_type}}</td>     
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#LocationModal"><a href="javascript:void(0);" ng-click="initialModal({{ list.id}},'{{list.location_type}}',{{ itemsPerPage}},{{$index}},{{list.status}})"><i class="fa fa-pencil"></i></a></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    <div class="modal fade" id="LocationModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>
                <form novalidate ng-submit="LocationForm.$valid && doLocationAction()" name="LocationForm">
                    <div class="modal-body">
                        <div class="form-group" ng-class="{ 'has-error' : sbtBtn && (!LocationForm.name.$dirty && LocationForm.name.$invalid) && (!LocationForm.status.$dirty && LocationForm.status.$invalid)}">
                            <input type="hidden" class="form-control" ng-model="id" name="id">
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="name" name="name" placeholder="Location" ng-change="errorMsg = null" required>
                                <i class="fa fa-user thm-color circular"></i>
                                <div class="help-block" ng-show="sbtBtn" ng-messages="LocationForm.name.$error">
                                    <div ng-message="required">This field is required</div>
                                    <div ng-if="errorMsg">{{errorMsg}}</div>
                                </div>
                                <br/>
                            </span>
                            <span class="input-icon icon-right">
                                <select name="status" ng-model="status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">In active</option>
                                </select>
                                <div class="help-block" ng-show="sbtBtn" ng-messages="LocationForm.status.$error">
                                    <div ng-message="required">This field is required</div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-sub" ng-click="sbtBtn = true">Submit</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>
</div>
