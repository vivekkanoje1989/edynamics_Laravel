<div class="row" ng-controller="productsCtrl" ng-init="manageProducts()">  
    <div>
          <flash-message duration="5000"></flash-message>
     </div>
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Manage Products</span>
                <a href="" data-toggle="modal" data-target="#productModal" ng-click="initialProductModal(0,'',0,'')" class="btn btn-info">Create New Product</a>&nbsp;&nbsp;&nbsp;
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
                      <input type="text" ng-model="search" class="form-control" style="width:25%;"  placeholder="Search">
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
                                SR. No.
                            </th>                       
                            <th style="width: 30%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'product_name'; reverseSort = !reverseSort">Products
                                    <span ng-show="orderByField == 'product_name'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>  
                            
                            <th style="width: 30%">
                                <a href="javascript:void(0);" ng-click="orderByField = 'status'; reverseSort = !reverseSort">Status
                                    <span ng-show="orderByField == 'status'">
                                        <span ng-show="!reverseSort">^</span><span ng-show="reverseSort">v</span>
                                    </span>
                                </a>
                            </th>
                            
                            <th style="width: 5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" dir-paginate="list in productList| filter:search |itemsPerPage:itemsPerPage| orderBy:orderByField:reverseSort">
                            <td>{{ itemsPerPage * (noOfRows-1)+$index+1 }}</td>
                            <td>{{ list.product_name}}</td>                          
                            <td>{{ list.status === 1 ? "Active" : "Deactive"}}</td>                          
                            <td class="fa-div">
                                <div class="fa-hover" tooltip-html-unsafe="Edit" style="display: block;" data-toggle="modal" data-target="#productModal"><a href="javascript:void(0);" ng-click="initialProductModal({{ list.product_id}},'{{list.product_name}}',{{ list.status}},$index)"><i class="fa fa-pencil"></i></a></div>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
                <div class="DTTTFooter">
                    <div class="col-sm-6">
                        <!--<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing {{itemsPerPage * (noOfRows-1)+1}} to of {{ listUsersLength }} entries</div>-->
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">&nbsp;</div>
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
    <div class="modal fade" id="productModal" role="dialog" tabindex="-1">    
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" align="center">{{heading}}</h4>
                </div>
                
                <form ng-submit="frmProduct.$valid && processProducts()" name="frmProduct"  novalidate>
                    <div class="modal-body">
                        <div ng-if="errorMsg" class="sp-err">{{errorMsg}}</div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" ng-model="product_id" name="product_id">
                            
                            <span class="input-icon icon-right">
                                <input type="text" class="form-control" ng-model="product_name" name="product_name" placeholder="Product Name" ng-change="errorMsg = null" required>
                                <i class="fa fa-users thm-color circular"></i>
                                <div class="help-block" ng-show="btnProduct" ng-if="display_msg" ng-messages="frmProduct.product_name.$error">
                                    <div ng-message="required" class="sp-err">Product name cannot be blank.</div>
                                </div>
                            </span>
                        </div>
                        
                        
                        <div class="form-group">
                                <div class="control-group">
                                    <div class="radio">
                                        <label>
                                            <input name="status" type="radio" ng-model="status" value="1" class="colored-success" required />
                                            <span class="text">Active</span>
                                        </label> &nbsp;
                                        <label>
                                            <input name="status" type="radio" ng-model="status" value="0" class="colored-danger" required />
                                            <span class="text"> Deactive</span>
                                        </label>
                                    </div>
                                    <div class="help-block" ng-show="btnProduct"  ng-if="display_msg" ng-messages="frmProduct.status.$error">
                                           <div ng-message="required" class="sp-err" >Status cannot be blank.</div>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer" align="center">
                        <button type="Submit" class="btn btn-sub" ng-click="btnProduct = true;display_msg=true">Submit</button>
                    </div> 
                </form>           
            </div>
        </div>
    </div>

    
</div>

