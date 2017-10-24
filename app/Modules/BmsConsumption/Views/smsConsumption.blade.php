<style>
    .tabsets ul li{
        width:50%;
    }
</style>
<div class="row" ng-controller="smsController" ng-init="vbreadcumbs = [
				{'displayName': 'Home', 'url': 'goDashboard()'},
				{'displayName': 'Settings', 'url': ''},
				{'displayName': 'Consumption', 'url': ''},
				{'displayName': 'Sms Consumption', 'url': ''}
			]">
    <div class="page-breadcrumbs {{settings.fixed.breadcrumbs ? 'breadcrumbs-fixed' : ''}}" style=" position: relative; top: -98px;box-shadow: 0 2px 4px 0 rgba(245, 238, 238, 0.15)" ng-init="">
		<ol class="breadcrumb" >
			<i class="fa fa-home" aria-hidden="true" style="font-size: 20px;color: gray;">&nbsp;</i>
			<li ng-repeat="crumb in vbreadcumbs" ng-class="{ active: $last }"><a href="javascript:void(0)" ng-click="{{crumb.url}}" ng-if="!$last">{{ crumb.displayName }}&nbsp;</a><span ng-show="$last">{{ crumb.displayName }}</span>
			</li>
		</ol>
	</div>
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <h5 class="row-title"><i class="fa fa-arrow-circle-o-right themeprimary"></i>SMS Reports</h5>
        <div class="col-lg-12 col-sm-6 col-xs-12">
                <tabset class="tabsets">
                    <tab heading="SMS LOG'S REPORT">
                        <div data-ng-include=" '/bmsConsumption/smsReport' "></div>
                    </tab>
                    <tab heading="SMS LOG'S" class="uploadsTab">
                        <div data-ng-include=" '/bmsConsumption/smsLogs' "></div>
                    </tab>
                </tabset>
        </div>
    </div>
</div>



