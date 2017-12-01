@extends('layouts/frontend/Edynamics/main')
@section('content') 
<section>
    <div id="index-banner" class="parallax-container parallax-cont-skew ">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="pagename">
                    <h2 class="header center teal-text text-lighten-2">BMS Network </h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="/frontend/Edynamics/img/about-us-banner.jpg" alt="Unsplashed background img 1"></div>
        <div class="skewed-bg-inn">
            <div class="content container">
                <div>Home - BMS Network</div>
            </div>
        </div>
    </div>
</section>
<section class="iconic">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="divider-new pt-5" >
                    <h2 class="h2-responsive  blue-text wow fadeIn m0">BMS Network Health Dashboard  </h2>
                </div>
            </div>
            <p class=" mt20">BMS network is designed to give live feed statistics to our clients of BMS network. It is a transparent step to give the live feed information of various services installed & operated from BMS network.
            </p>
            <div class="col-md-8 mb10 col-md-offset-4">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#mumbai">BMS Mumbai (Asia)</a></li>
                    <li class="disabled bg-gray disabledTab"><a data-toggle="pill" href="#singapore">BMS Singapore (Asia)</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="mumbai" class="tab-pane fade in active">
                    <div id="no-more-tables">
                        <table class="table table-bordered   mt20 table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th>Services </th>
                                    <th>Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i> BMS Virtual Private Cloud Services</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i> BMS Elastic Load Balancers</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i>  BMS Relational Database Services</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i>  BMS Private DNS</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i> 	BMS Auto Scaling</td>
                                    <td data-title="Current Status">Service is operating normally</td>      
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i> BMS Storage Gateway</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i> BMS SMS Services  </td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                                <tr>
                                    <td data-title="Services"><i class="fa green-text mr5 fa-check-circle"></i>BMS Cloud Telephony Services</td>
                                    <td data-title="Current Status">Service is operating normally</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="singapore" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
</section>
<div class="footertopred"> </div>
@endsection()