<div class="row" ng-controller="blogsCtrl" > 
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header">
                    <span class="widget-caption">Content Management</span>
                    <div class="widget-buttons">
                        <a href="" widget-maximize></a>
                        <a href="" widget-collapse></a>
                        <a href="" widget-dispose></a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Blog Management</span>

                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
            </div>
            <div class="widget-body table-responsive">
                                    <center><h4>Update Page Content</h4></center>
                                    <form name="contentPageForm" novalidate ng-submit="contentPageForm.$valid && updatecontentPage(contentPage)" ng-init="manageContentPage()">  
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Page <span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <select class="form-control" ng-controller="cotentPageListCtrl" ng-model="contentPage.page_id">
                                                                <option value="">Select Page</option>
                                                                <option ng-repeat="page in listPages track by $index" value="{{page.page_id}}" ng-selected="{{ page.page_id == contentPage.page_id}}">{{page.page_name}}</option>
                                                            </select>
                                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Page Name<span class="sp-err">*</span></label>
                                                        <span class="input-icon icon-right">
                                                            <input type="text" ng-model="contentPage.page_name" name="page_name" class="form-control" capitalizeFirst oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')" maxlength="15" required>
                                                            <i class="fa fa-address-card"></i>
                                                            <div ng-messages="contentPageForm.page_name.$error">
                                                                <div ng-message="required">This field is required.</div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Page Title<span class="sp-err">*</span></label>
                                                        <span class="input-icon icon-right">
                                                            <input type="text" ng-model="contentPage.page_title" name="page_title" class="form-control" capitalizeFirst oninput="if (/[^A-Za-z ]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z ]/g,'')" maxlength="15" required>
                                                            <i class="fa fa-address-card"></i>
                                                            <div ng-messages="contentPageForm.page_title.$error">
                                                                <div ng-message="required">This field is required.</div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Seo Url<span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <input type="text" ng-model="contentPage.seo_url" name="seo_url" class="form-control">                                                             
                                                        </span>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Meta Description<span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <textarea rows="3" cols="30" ng-model="contentPage.meta_description" name="meta_description" class="form-control"></textarea>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Meta Keywords<span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <textarea rows="3" cols="30" ng-model="contentPage.meta_Keywords" name="meta_Keywords" class="form-control"></textarea>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Canonical Tag<span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <input type="text" ng-model="contentPage.canonical_tag" name="canonical_tag" class="form-control">                                                             
                                                        </span>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Position<span class="sp-err"></span></label>
                                                        <span class="input-icon icon-right">
                                                            <input type="text" ng-model="contentPage.Position" name="Position" class="form-control">                                                             
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="">Status <span class="sp-err">*</span></label>
                                                        <span class="input-icon icon-right">
                                                            <select class="form-control" ng-model="contentPage.status">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <style>
                                                    .editor-text {
                                                        border: 1px solid #cecece;
                                                        margin-top: 10px;
                                                        background-color: #fff;
                                                        padding: 10px;
                                                    }
                                                </style>
                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                    <div class="widget flat radius-bordered">
                                                        <div class="widget-header bordered-bottom bordered-themeprimary">
                                                            <span class="widget-caption">Page Content</span>
                                                        </div>
                                                        <div class="widget-body no-padding">
                                                            <div ng-controller="TextAngularCtrl">
                                                                <div text-angular  name="demo-editor" ta-text-editor-class="editor-text" ta-html-editor-class="editor-text"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-primary btn-submit-last" ng-disabled="">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
