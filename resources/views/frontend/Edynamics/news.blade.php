@extends('layouts/frontend/Edynamics/main')
@section('content') 
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
<section class="iconic" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="divider-new pt-5" >
                    <h2 class="h2-responsive  blue-text wow fadeIn mb50px">Letest News </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-8 ">
                <?php foreach ($news as $news) {
                    ?>
                    <div  class="panel panel-default post-panel wow fadeInUp " style="display: block;" >
                        <div class="panel-heading">
                            <div class="red-head"><?php echo $news->news_title; ?></div> 
                        </div>
                        <div  class="post-date"><?php echo $news->created_date; ?></small></div>
                        <div class="panel-body">
                            <div class="row m0">
                                <div class="col-lg-5 col-md-5 col-sm-5 p0 col-xs-12"><img src="[[config('global.s3Path')]]News/news_banner_images/<?php echo $news->news_banner_images; ?>" class="img-responsive"/></div>
                                <div class="col-lg-7 col-md-7 col-sm-7 pr0 col-xs-12"><p class="post-shortdtl"><?php echo $news->news_short_description; ?></p>
                                    <div class="text-right"><a href="[[ URL::to('/') ]]/news-details/<?php echo $news->id; ?>" class=" red-text"> Read more...</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="post-link--block mb50px">
                    <div class="bg-red p15">
                        <p class=" text-center white-text font18 m0">RECENT POST</p></div>
                    <ul class="post-list">
                        <?php for($i=0;$i<count($news);$i++) {
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

Tweets about edynamicsindia
<div class="footertopred"> </div>
@endsection()