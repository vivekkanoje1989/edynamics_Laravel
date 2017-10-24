<div class="row" ng-controller="hrController" ng-init="showchartdata()">
<div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style="position: fixed; top: 44px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="vbreadcumbs = [
            {'displayName': 'Home', 'url': 'goDashboard()'},
            {'displayName': 'Hr', 'url': ''},
            {'displayName': 'Employee Management', 'url': ''},
            {'displayName': 'Organisation Chart', 'url': 'goListemployee()'}
        ]">
    <ol class="breadcrumb" >
        <i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
        <li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="javascript:void(0)" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
        </li>
    </ol>
</div>
<style>
    .google-visualization-orgchart-node{
            background: #ddd !important;
            padding:0 10px !important;
            border: none !important;
        }                  
        .google-visualization-orgchart-node, .google-visualization-orgchart-node-medium, .google-visualization-orgchart-nodesel
        {
            background: transparent !important;
            border: none;
            box-shadow: none;
        }            	
        .imgdata
        {
            border-radius: 50px;
            width: 90px;
            height: 90px;
            /*border: 4px double red;*/	
        }
        .myblock
        {
            border: 1px solid;
            position: relative;
            bottom: 10px;
            height:auto;
            width: 128px;
            /*z-index: -1;*/
            background-color: rgba(253, 42, 42, 0.85);
            left: 5px;
            color: white;
        }
        .mytext
        {
            position: absolute;
            left: 0;
            bottom: 0;
            color:black
        }	
</style>	
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">Organization Chart</span>
                
                <div class="widget-buttons">
                    <a href="" widget-maximize></a>
                    <a href="" widget-collapse></a>
                    <a href="" widget-dispose></a>
                </div>
                <div id="chart_div" class="table-responsive" ng-model="chart_div"></div>
                
                <br><br>
            </div>
            
        </div>
    </div>
</div>

