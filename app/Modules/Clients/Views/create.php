<div class="row" ng-controller="clientInfoCtrl" >  
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Manage Clients</span>

                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
            </div>
            <div class="widget-body table-responsive">     
                <form  name="frmcrtClients"  novalidate enctype="multipart/form-data">
                    <input type="hidden" ng-model="csrfToken" name="csrftoken" id="csrftoken" ng-init="csrfToken = '<?php echo csrf_token(); ?>'" class="form-control">
                    <table class="table table-hover table-striped table-bordered" at-config="config">
                        <thead class="bord-bot">
                            <tr>
                                <td colspan="2">Create Client</td>
                            <tr>
                        </thead>
                        <tbody>
                        <input type="hidden" ng-model="id" name="blogId" id="blogId">    
                        <tr>
                            <td>Client Groups<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Marketing Name<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Legal Name<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Company<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Company Logo<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Address<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                       <tr>
                            <td>Pin Code<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        
                         <tr>
                            <td>Country<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                         <tr>
                            <td>State<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                         <tr>
                            <td>City<span class="sp-err">*</span></td>
                            <td>
                                
                            </td>
                        </tr>
                        
                        
                        <tr><td>Website Url<span class="sp-err">*</span></td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="Submit" class="btn btn-sub" ng-click="sbtBtn = true">Submit</button></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>