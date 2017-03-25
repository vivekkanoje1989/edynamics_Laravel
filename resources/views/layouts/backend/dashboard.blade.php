<div ng-controller="DashboardCtrl">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themesecondary">
                            <div class="databox-piechart">
                                <div class="easyPieChart block-center" ui-jq="easyPieChart" ui-options="{ percent: 50, lineWidth: 3, barColor:'#fff', trackColor: 'rgba(255,255,255,0.1)' , scaleColor:false, size: 47, lineCap: 'butt', animate: 500 }"><span class="white font-90">50%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themesecondary">28</span>
                            <div class="databox-text darkgray">NEW TASKS</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor">
                            <div class="databox-piechart">
                                <div class="easyPieChart block-center" ui-jq="easyPieChart" ui-options="{ percent: 15, lineWidth: 3, barColor:'#fff', trackColor: 'rgba(255,255,255,0.1)' , scaleColor:false, size: 47, lineCap: 'butt', animate: 500 }"><span class="white font-90">15%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themethirdcolor">5</span>
                            <div class="databox-text darkgray">NEW MESSAGE</div>
                            <div class="databox-stat themethirdcolor radius-bordered">
                                <i class="stat-icon  icon-lg fa fa-envelope-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary">
                            <div class="databox-piechart">
                                <div class="easyPieChart block-center" ui-jq="easyPieChart" ui-options="{ percent: 76, lineWidth: 3, barColor:'#fff', trackColor: 'rgba(255,255,255,0.1)' , scaleColor:false, size: 47, lineCap: 'butt', animate: 500 }"><span class="white font-90">76%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themeprimary">92</span>
                            <div class="databox-text darkgray">NEW USERS</div>
                            <div class="databox-state bg-themeprimary">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left no-padding">
                            <img src="/backend/assets/img/avatars/John-Smith.jpg" style="height: 65px; width: 65px;">
                        </div>
                        <div class="databox-right padding-top-20">
                            <div class="databox-stat palegreen">
                                <i class="stat-icon icon-xlg fa fa-phone"></i>
                            </div>
                            <div class="databox-text darkgray">JOHN SMITH</div>
                            <div class="databox-text darkgray">TOP RESELLER [[ asset('js/app.js') ]]</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="dashboard-box">
                        <div class="box-header">
                            <div class="deadline">
                                Remaining Days: 109
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="progress-handle">day 20</div>
                            <progressbar class="progress-xs progress-no-radius bg-whitesmoke" value="20"></progressbar>
                        </div>
                        <div class="box-tabbs">
                            <tabset flat="true" justified="true">
                                <tab heading="Real-Time">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div flot-chart-realtime class="chart chart-lg no-margin"></div>
                                        </div>
                                    </div>
                                </tab>
                                <tab heading="Visits">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div height="250px" style="width: 100%; display: block;" ui-jq="plot" ui-options="{{visitChartData}}, {{visitChartOptions}}"
                                                 class="chart chart-lg no-margin">
                                            </div>
                                        </div>
                                    </div>
                                </tab>
                                <tab heading="Bandwidth">
                                    <div class="databox-sparkline bg-themeprimary">
                                        <div id="dashboard-bandwidth-chart" style="height: 240px;" ui-jq="sparkline" ui-options="[500, 400, 100, 450, 300, 200, 100, 200], {type:'line', height:250, width:{{boxWidth}}, lineColor:'#fff', fillColor:'rgba(255,255,255,.2)', spotRadius:0, spotColor:'#fafafa', minSpotColor:'#fafafa', maxSpotColor:'#fafafa', highlightSpotColor:'#fff', highlightLineColor:'#fff', lineWidth:2  }"></div>
                                    </div>
                                </tab>
                                <tab heading="Sales">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="databox databox-xlg databox-vertical databox-inverted databox-shadowed">
                                                <div class="databox-top">
                                                    <div class="databox-sparkline">
                                                        <span ui-jq="sparkline" ui-options="[1,2,4,3,5,6,8,7,11,14,11,12], {type:'line', height:125, width:125, fillColor:'', lineColor:'{{settings.color.themeprimary}}', spotColor:'#fafafa', minSpotColor:'#fafafa' , maxSpotColor:'#ffce55', highlightSpotColor:'#ffce55' , highlightLineColor:'#ffce55', lineWidth:'1.5' , spotRadius:2 }"></span>
                                                    </div>
                                                </div>
                                                <div class="databox-bottom no-padding text-align-center">
                                                    <span class="databox-number lightcarbon no-margin">224</span>
                                                    <span class="databox-text lightcarbon no-margin">Sale Unit / Hour</span>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="databox databox-xlg databox-vertical databox-inverted databox-shadowed">
                                                <div class="databox-top">
                                                    <div class="databox-sparkline">
                                                        <span ui-jq="sparkline" ui-options="[100,208,450,298,450,776,234,680,1100,1400,1000,1200], {type:'line', height:125, width:125, fillColor:'', lineColor:'{{settings.color.themefourthcolor}}', spotColor:'#fafafa', minSpotColor:'#fafafa' , maxSpotColor:'#8cc474', highlightSpotColor:'#8cc474' , highlightLineColor:'#8cc474', lineWidth:'1.5' , spotRadius:2 }"></span>
                                                    </div>
                                                </div>
                                                <div class="databox-bottom no-padding text-align-center">
                                                    <span class="databox-number lightcarbon no-margin">7063$</span>
                                                    <span class="databox-text lightcarbon no-margin">Income / Hour</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="databox databox-xlg databox-vertical databox-inverted databox-shadowed">
                                                <div class="databox-top">
                                                    <div class="databox-piechart">
                                                        <div class="easyPieChart block-center" ui-jq="easyPieChart" ui-options="{ percent: 75, lineWidth: 8, barColor:'{{settings.color.themeprimary}}', trackColor: '#eee' , scaleColor:'#fff', size: 125, lineCap: 'butt', animate: 500 }"><span class="font-200"><i class="fa fa-gift themeprimary"></i></span></div>
                                                        <div class="databox-bottom no-padding text-align-center">
                                                            <span class="databox-number lightcarbon no-margin">9</span>
                                                            <span class="databox-text lightcarbon no-margin">NEW ORDERS</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="databox databox-xlg databox-vertical databox-inverted  databox-shadowed">
                                                <div class="databox-top">
                                                    <div class="databox-piechart">
                                                        <div class="easyPieChart block-center" ui-jq="easyPieChart" ui-options="{ percent: 40, lineWidth: 8, barColor:'{{settings.color.themethirdcolor}}', trackColor: '#eee' , scaleColor:'#fff', size: 125, lineCap: 'butt', animate: 500 }"><span class="white font-200"><i class="fa fa-tags themethirdcolor"></i></span></div>
                                                    </div>
                                                </div>
                                                <div class="databox-bottom no-padding text-align-center">
                                                    <span class="databox-number lightcarbon no-margin">11</span>
                                                    <span class="databox-text lightcarbon no-margin">NEW TICKETS</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </tab>
                            </tabset>
                            <div class="box-visits">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <div class="notification">
                                            <div class="clearfix">
                                                <div class="notification-icon">
                                                    <i class="fa fa-gift palegreen bordered-1 bordered-palegreen"></i>
                                                </div>
                                                <div class="notification-body">
                                                    <span class="title">Kate birthday party</span>
                                                    <span class="description">08:30 pm</span>
                                                </div>
                                                <div class="notification-extra">
                                                    <i class="fa fa-calendar palegreen"></i>
                                                    <i class="fa fa-clock-o palegreen"></i>
                                                    <span class="description">at home</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <div class="notification">
                                            <div class="clearfix">
                                                <div class="notification-icon">
                                                    <i class="fa fa-check azure bordered-1 bordered-azure"></i>
                                                </div>
                                                <div class="notification-body">
                                                    <span class="title">Hanging out with kids</span>
                                                    <span class="description">03:30 pm - 05:15 pm</span>
                                                </div>
                                                <div class="notification-extra">
                                                    <i class="fa fa-clock-o azure"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <div class="notification">
                                            <div class="clearfix">
                                                <div class="notification-icon">
                                                    <i class="fa fa-phone bordered-1 bordered-orange orange"></i>
                                                </div>
                                                <div class="notification-body">
                                                    <span class="title">Meeting with Patty</span>
                                                    <span class="description">01:00 pm</span>
                                                </div>
                                                <div class="notification-extra">
                                                    <i class="fa fa-clock-o orange"></i>
                                                    <span class="description">office</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="orders-container">
                <div class="orders-header">
                    <h6>Latest Orders</h6>
                </div>
                <ul class="orders-list">
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
                                <div class="item-booker">Ned Stards</div>
                                <div class="item-time">
                                    <i class="fa fa-calendar"></i>
                                    <span>10 minutes ago</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
                                <div class="item-price">
                                    <span class="currency">$</span>
                                    <span class="price">400</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="">
                            <i></i>
                        </a>
                    </li>
                    <li class="order-item top">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
                                <div class="item-booker">Steve Lewis</div>
                                <div class="item-time">
                                    <i class="fa fa-calendar"></i>
                                    <span>2 hours ago</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
                                <div class="item-price">
                                    <span class="currency">$</span>
                                    <span class="price">620</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="">
                            <i></i>
                        </a>
                    </li>
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
                                <div class="item-booker">John Ford</div>
                                <div class="item-time">
                                    <i class="fa fa-calendar"></i>
                                    <span>Today 8th July</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
                                <div class="item-price">
                                    <span class="currency">$</span>
                                    <span class="price">220</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="">
                            <i></i>
                        </a>
                    </li>
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
                                <div class="item-booker">Kim Basinger</div>
                                <div class="item-time">
                                    <i class="fa fa-calendar"></i>
                                    <span>Yesterday 7th July</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
                                <div class="item-price">
                                    <span class="currency">$</span>
                                    <span class="price">400</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="">
                            <i></i>
                        </a>
                    </li>
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
                                <div class="item-booker">Steve Lewis</div>
                                <div class="item-time">
                                    <i class="fa fa-calendar"></i>
                                    <span>5th July</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
                                <div class="item-price">
                                    <span class="currency">$</span>
                                    <span class="price">340</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="">
                            <i></i>
                        </a>
                    </li>
                </ul>
                <div class="orders-footer">
                    <a class="show-all" href=""><i class="fa fa-angle-down"></i> Show All</a>
                    <div class="help">
                        <a href=""><i class="fa fa-question"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-themeprimary">
                    <i class="widget-icon fa fa-tasks themeprimary"></i>
                    <span class="widget-caption themeprimary">Task Board</span>
                </div><!--Widget Header-->
                <div class="widget-body no-padding">
                    <div class="task-container">
                        <div class="task-search">
                            <span class="input-icon">
                                <input type="text" class="form-control" placeholder="Search Tasks">
                                <i class="fa fa-search gray"></i>
                            </span>
                        </div>
                        <ul class="tasks-list">
                            <li class="task-item">
                                <div class="task-check">
                                    <label>
                                        <input type="checkbox">
                                        <span class="text"></span>
                                    </label>
                                </div>
                                <div class="task-state">
                                    <span class="label label-yellow">
                                        In Progress
                                    </span>
                                </div>
                                <div class="task-time">1 hour ago</div>
                                <div class="task-body">Ask to the sysadmins to install Python 3 on the server and run it</div>
                                <div class="task-creator"><a href="">Cameron Hetfield</a></div>
                                <div class="task-assignedto">assigned to you</div>
                            </li>
                            <li class="task-item">
                                <div class="task-check">
                                    <label>
                                        <input type="checkbox">
                                        <span class="text"></span>
                                    </label>
                                </div>
                                <div class="task-state">
                                    <span class="label label-orange">
                                        Active
                                    </span>
                                </div>
                                <div class="task-time">2 hours ago</div>
                                <div class="task-body">Write documentation for the new API with test and deploy specifications</div>
                                <div class="task-creator"><a href="">Behrang Nitsche</a></div>
                                <div class="task-assignedto">assigned to you</div>
                            </li>
                            <li class="task-item">
                                <div class="task-check">
                                    <label>
                                        <input type="checkbox">
                                        <span class="text"></span>
                                    </label>
                                </div>
                                <div class="task-state">
                                    <span class="label label-palegreen">
                                        Approved
                                    </span>
                                </div>
                                <div class="task-time">yesterday</div>
                                <div class="task-body">Code refactoring and rewriting silly codes and test it</div>
                                <div class="task-creator"><a href="">David Fincher</a></div>
                                <div class="task-assignedto">assigned to Kim</div>
                            </li>
                        </ul>
                    </div>
                </div><!--Widget Body-->
            </div>

        </div>
        <div class="col-lg-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col=lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="databox databox-lg databox-inverted radius-bordered databox-shadowed databox-graded databox-vertical">
                        <div class="databox-top bg-palegreen no-padding">
                            <div class="databox-stat white bg-palegreen font-120">
                                <i class="stat-icon fa fa-caret-down icon-xlg"></i>
                            </div>
                            <div class="horizontal-space space-lg"></div>
                            <div class="databox-sparkline no-margin">
                                <span ui-jq="sparkline" ui-options="[7, 6, 5, 7, 9, 10, 8, 7, 6, 6, 4, 7, 8], {type:'bar', height:82, width:'100%', barColor:'#b0dc81', barWidth:10, barSpacing:5}"></span>
                            </div>
                        </div>
                        <div class="databox-bottom no-padding">
                            <div class="databox-row">
                                <div class="databox-cell cell-6 text-align-left">
                                    <span class="databox-text">Sales Total</span>
                                    <span class="databox-number">$23,657</span>
                                </div>
                                <div class="databox-cell cell-6 text-align-right">
                                    <span class="databox-text">September</span>
                                    <span class="databox-number font-70">$1,257</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col=lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="databox databox-lg databox-inverted radius-bordered databox-shadowed databox-graded databox-vertical">
                        <div class="databox-top bg-orange no-padding">
                            <div class="databox-stat white bg-orange font-120">
                                <i class="stat-icon fa fa-caret-up icon-xlg"></i>
                            </div>
                            <div class="horizontal-space space-lg"></div>
                            <div class="databox-sparkline no-margin">
                                <span ui-jq="sparkline" ui-options="[10,7,10,8,4,6, 6, 4, 7, 8 ,4,4,8], {type:'line', height:82, width:'90%', fillColor:'', lineColor:'#fff', spotColor:'#fafafa', minSpotColor:'#fafafa' , maxSpotColor:'#fafafa', highlightSpotColor:'#fafafa' , highlightLineColor:'#fafafa', lineWidth:'2' , spotRadius:3 }"></span>
                            </div>
                        </div>
                        <div class="databox-bottom no-padding">
                            <div class="databox-row">
                                <div class="databox-cell cell-6 text-align-left">
                                    <span class="databox-text">Users Total</span>
                                    <span class="databox-number">76,109</span>
                                </div>
                                <div class="databox-cell cell-6 text-align-right">
                                    <span class="databox-text">New</span>
                                    <span class="databox-number font-70">7,540</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col=lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="databox databox-lg databox-inverted radius-bordered databox-shadowed databox-graded databox-vertical">
                        <div class="databox-top bg-azure no-padding">
                            <div class="databox-stat white bg-azure font-120">
                                <i class="stat-icon fa fa-caret-up icon-xlg"></i>
                            </div>
                            <div class="horizontal-space space-lg"></div>
                            <div class="databox-sparkline no-margin">
                                <span ui-jq="sparkline" ui-options="[2,6,7,9,8,5,3,4,4,3,6,7], {type:'line', height:85, width:'100%', fillColor:'rgba(255,255,255,.2)', lineColor:'#fff', spotColor:'#fafafa', minSpotColor:'#fafafa' , maxSpotColor:'#ffce55', highlightSpotColor:'#fff' , highlightLineColor:'#fff', lineWidth:'3' , spotRadius:0 }"></span>
                            </div>
                        </div>
                        <div class="databox-bottom no-padding">
                            <div class="databox-row">
                                <div class="databox-cell cell-6 text-align-left">
                                    <span class="databox-text">Visits Total</span>
                                    <span class="databox-number">990,541</span>
                                </div>
                                <div class="databox-cell cell-6 text-align-right">
                                    <span class="databox-text">September</span>
                                    <span class="databox-number font-70">292,123</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget-header bordered-bottom bordered-themesecondary">
                            <i class="widget-icon fa fa-tags themesecondary"></i>
                            <span class="widget-caption themesecondary">Ticket Board</span>
                        </div><!--Widget Header-->
                        <div class="widget-body  no-padding">
                            <div class="tickets-container">
                                <ul class="tickets-list">
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <img src="/backend/assets/img/avatars/adam-jansen.jpg" class="user-avatar">
                                                <span class="user-name">Adam Johnson</span>
                                                <span class="user-at">at</span>
                                                <span class="user-company">Microsoft</span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time">1 Hours Ago</span>
                                            </div>
                                            <div class="ticket-type  col-lg-2 col-sm-6 col-xs-12">
                                                <span class="divider hidden-xs"></span>
                                                <span class="type">Issue</span>
                                            </div>
                                            <div class="ticket-state bg-palegreen">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <img src="/backend/assets/img/avatars/divyia.jpg" class="user-avatar">
                                                <span class="user-name">Divyia Phillips</span>
                                                <span class="user-at">at</span>
                                                <span class="user-company">Dribbble</span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time">3 Hours Ago</span>
                                            </div>
                                            <div class="ticket-type  col-lg-2 col-sm-6 col-xs-12">
                                                <span class="divider hidden-xs"></span>
                                                <span class="type">Payment</span>
                                            </div>
                                            <div class="ticket-state bg-palegreen">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <img src="/backend/assets/img/avatars/Matt-Cheuvront.jpg" class="user-avatar">
                                                <span class="user-name">Nicolai Larson</span>
                                                <span class="user-at">at</span>
                                                <span class="user-company">Google</span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time">18 Hours Ago</span>
                                            </div>
                                            <div class="ticket-type  col-lg-2 col-sm-6 col-xs-12">
                                                <span class="divider hidden-xs"></span>
                                                <span class="type">Issue</span>
                                            </div>
                                            <div class="ticket-state bg-darkorange">
                                                <i class="fa fa-times"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <img src="/backend/assets/img/avatars/Sergey-Azovskiy.jpg" class="user-avatar">
                                                <span class="user-name">Bill Jackson</span>
                                                <span class="user-at">at</span>
                                                <span class="user-company">Mabna</span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time">2 days Ago</span>
                                            </div>
                                            <div class="ticket-type  col-lg-2 col-sm-6 col-xs-12">
                                                <span class="divider hidden-xs"></span>
                                                <span class="type">Payment</span>
                                            </div>
                                            <div class="ticket-state bg-palegreen">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <img src="/backend/assets/img/avatars/John-Smith.jpg" class="user-avatar">
                                                <span class="user-name">Eric Clapton</span>
                                                <span class="user-at">at</span>
                                                <span class="user-company">Musicker</span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time">2 days Ago</span>
                                            </div>
                                            <div class="ticket-type  col-lg-2 col-sm-6 col-xs-12">
                                                <span class="divider hidden-xs"></span>
                                                <span class="type">Info</span>
                                            </div>
                                            <div class="ticket-state bg-yellow">
                                                <i class="fa fa-info"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="databox databox-xxlg databox-vertical databox-inverted">
                <div class="databox-top bg-whitesmoke no-padding">
                    <div class="databox-row row-2 bg-orange no-padding">
                        <div class="databox-cell cell-1 text-align-center no-padding padding-top-5">
                            <span class="databox-number white"><i class="fa fa-bar-chart-o no-margin"></i></span>
                        </div>
                        <div class="databox-cell cell-8 no-padding padding-top-5 text-align-left">
                            <span class="databox-number white">PAGE VIEWS</span>
                        </div>
                        <div class="databox-cell cell-3 text-align-right padding-10">
                            <span class="databox-text white">13 DECEMBER</span>
                        </div>
                    </div>
                    <div class="databox-row row-4">
                        <div class="databox-cell cell-6 no-padding padding-10 padding-left-20 text-align-left">
                            <span class="databox-number orange no-margin">534,908</span>
                            <span class="databox-text sky no-margin">OVERAL VIEWS</span>
                        </div>
                        <div class="databox-cell cell-2 no-padding padding-10 text-align-left">
                            <span class="databox-number orange no-margin">4,129</span>
                            <span class="databox-text darkgray no-margin">THIS WEEK</span>
                        </div>
                        <div class="databox-cell cell-2 no-padding padding-10 text-align-left">
                            <span class="databox-number orange no-margin">329</span>
                            <span class="databox-text darkgray no-margin">YESTERDAY</span>
                        </div>
                        <div class="databox-cell cell-2 no-padding padding-10 text-align-left">
                            <span class="databox-number orange no-margin">104</span>
                            <span class="databox-text darkgray no-margin">TODAY</span>
                        </div>
                    </div>
                    <div class="databox-row row-6 no-padding">
                        <div class="databox-sparkline">
                            <span ui-jq="sparkline" ui-options="[5,7,6,5,9,4,3,7,2], {type:'line', height:126, width:'100%', fillColor:'#37c2e2', lineColor:'#37c2e2', spotColor:'#fafafa', minSpotColor:'#fafafa' , maxSpotColor:'#ffce55', highlightSpotColor:'#f5f5f5' , highlightLineColor:'#f5f5f5', lineWidth:'2' , spotRadius:0 }"></span>
                        </div>
                    </div>
                </div>
                <div class="databox-bottom bg-sky no-padding">
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Mon</span>
                    </div>
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Tues</span>
                    </div>
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Wed</span>
                    </div>
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Thu</span>
                    </div>
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Fri</span>
                    </div>
                    <div class="databox-cell cell-2 text-align-center no-padding padding-top-5">
                        <span class="databox-header white">Sat</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="databox databox-xxlg databox-vertical databox-shadowed bg-white radius-bordered padding-5">
                <div class="databox-top">
                    <div class="databox-row row-12">
                        <div class="databox-cell cell-3 text-center">
                            <div class="databox-number number-xxlg sonic-silver">164</div>
                            <div class="databox-text storm-cloud">online</div>
                        </div>
                        <div class="databox-cell cell-9 text-align-center">
                            <div class="databox-row row-6 text-left">
                                <span class="badge badge-palegreen badge-empty margin-left-5"></span>
                                <span class="databox-inlinetext uppercase darkgray margin-left-5">NEW</span>
                                <span class="badge badge-yellow badge-empty margin-left-5"></span>
                                <span class="databox-inlinetext uppercase darkgray margin-left-5">RETURNING</span>
                            </div>
                            <div class="databox-row row-6">
                                <div class="progress bg-yellow progress-no-radius">
                                    <div class="progress-bar progress-bar-palegreen" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="databox-bottom">
                    <div class="databox-row row-12">
                        <div class="databox-cell cell-7 text-center  padding-5">
                            <div ui-jq="plot" ui-options="{{visitorSourcePieData}}, {{visitorSourcePieOptions}}" class="chart"></div>
                        </div>
                        <div class="databox-cell cell-5 text-center no-padding-left padding-bottom-30">
                            <div class="databox-row row-2 bordered-bottom bordered-ivory padding-10">
                                <span class="databox-text sonic-silver pull-left no-margin">Type</span>
                                <span class="databox-text sonic-silver pull-right no-margin uppercase">PCT</span>
                            </div>
                            <div class="databox-row row-2 bordered-bottom bordered-ivory padding-10">
                                <span class="badge badge-blue badge-empty pull-left margin-5"></span>
                                <span class="databox-text darkgray pull-left no-margin hidden-xs">FEED</span>
                                <span class="databox-text darkgray pull-right no-margin uppercase">46%</span>
                            </div>
                            <div class="databox-row row-2 bordered-bottom bordered-ivory padding-10">
                                <span class="badge badge-orange badge-empty pull-left margin-5"></span>
                                <span class="databox-text darkgray pull-left no-margin hidden-xs">PREFERRAL</span>
                                <span class="databox-text darkgray pull-right no-margin uppercase">21%</span>
                            </div>
                            <div class="databox-row row-2 bordered-bottom bordered-ivory padding-10">
                                <span class="badge badge-pink badge-empty pull-left margin-5"></span>
                                <span class="databox-text darkgray pull-left no-margin hidden-xs">DIRECT</span>
                                <span class="databox-text darkgray pull-right no-margin uppercase">12%</span>
                            </div>
                            <div class="databox-row row-2 bordered-bottom bordered-ivory padding-10">
                                <span class="badge badge-palegreen badge-empty pull-left margin-5"></span>
                                <span class="databox-text darkgray pull-left no-margin hidden-xs">EMAIL</span>
                                <span class="databox-text darkgray pull-right no-margin uppercase">11%</span>
                            </div>
                            <div class="databox-row row-2 padding-10">
                                <span class="badge badge-yellow badge-empty pull-left margin-5"></span>
                                <span class="databox-text darkgray pull-left no-margin hidden-xs">ORGANIC</span>
                                <span class="databox-text darkgray pull-right no-margin uppercase">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>