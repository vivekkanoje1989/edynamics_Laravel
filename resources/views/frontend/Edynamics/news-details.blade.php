@extends('layouts/frontend/Edynamics/main')
@section('content')
<section>
    <div id="index-banner" class="parallax-container parallax-cont-skew ">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="pagename">
                    <h2 class="header center teal-text text-lighten-2">News Room</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="/frontend/Edynamics/img/about-us-banner.jpg" alt="Unsplashed background img 1"></div>
        <div class="skewed-bg-inn">
            <div class="content container">
                <div>Home - News Room</div>
            </div>
        </div>
    </div>
</section>
<section class="iconic">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="divider-new pt-5" >
                    <h2 class="h2-responsive  blue-text wow fadeIn mb50px">Latest News </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-8 ">
                <div class="panel panel-default post-panel wow fadeInUp" data-wow-delay="0.2s">
                    <div class="panel-heading">
                        <div class="red-head">[[$newsdetail->news_title]]</div> 
                    </div>
                    <div  class="post-date">[[$newsdetail->created_date]]<small> by edynamics</small></div>
                    <div class="panel-body">
                        <div class="row m0">
                            <div class="col-lg-12 col-md-12 col-sm-12 p0 col-xs-12 post-detail"><img src="[[config('global.s3Path')]]/News/news_banner_images/[[$newsdetail->news_banner_images]]" width="100%" class="img-responsive"/></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 pr0 col-xs-12"><p class="">[[$newsdetail->news_description]]</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="post-link--block mb50px">
                    <div class="bg-red p15">
                        <p class=" text-center white-text font18 m0">RECENT POST</p></div>
                    <ul class="post-list">
                        <?php foreach($news as $news) {
                            ?>
                            <li><a href="[[ URL::to('/') ]]/news-details/<?php echo $news->id; ?>"> <?php echo $news->news_title; ?></a></li>
                        <?php } ?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<div class="footertopred"> </div>
@endsection() 
