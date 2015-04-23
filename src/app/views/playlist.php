<!doctype html>
<html class="no-js" ng-app="channel599">
    <?php $this->load->view('includes/head.site.php'); ?>
    <body class="site" ng-controller="PlaylistCtrl">

        <div class="controls">
            <button id="previous"><i class="ion-ios-skipbackward"></i></button>
            <button id="play"><i class="ion-ios-play"></i></button>
            <button id="pause"><i class="ion-ios-pause"></i></button>
            <button id="loading"><i class="ion-ios-loop-strong"></i></button>
            <button id="next"><i class="ion-ios-skipforward"></i></button>
        </div>

        <header class="masthead">
            <div class="wrap">
                <div class="title">
                    <h1><a href="">599</a></h1>
                </div>
                <div class="links">
                    <p><span class="lead">You're on Channel 599.</span>A music blog started in Rob's room in 2010</p>
                    <nav>
                        <a href="">Latest</a>
                        <a href="">Search</a>
                        <a href="">Archive</a>
                    </nav> 
                </div>
            </div>
        </header>

        <section class="playlist">

        <?php foreach ($songs as $song) : ?>
    
            <article class="song <?php echo $song->source ?>" data-source="<?php echo $song->source ?>" data-source-id="<?php echo $song->source_id ?>" data-source-url="<?php echo $song->source_url ?>">
                
                <div class="wrap">
                    <h2 class="title"><a href="<?php echo base_url() ?><?php echo $song->slug ?>"><?php echo $song->title ?></a></h2>
                    <div class="content">
                        <!-- <p class="text"><?php echo $song->text ?></p> -->
                        <div class="annotations">
                            <?php if ($song->annotations) : ?>
                            <?php foreach ($song->annotations as $annotation) : ?>
                                <div class="annotation" data-source-id="<?php echo $song->source_id ?>" data-timestamp="<?php echo $annotation->timestamp ?>">
                                    <p class="time"><?php echo $annotation->time ?></p>
                                    <p class="comment"><?php echo $annotation->text ?></p>
                                </div>
                            <?php endforeach;  endif; ?>
                        </div>
                        <p class="meta"><i class="ion-ios-person"></i> <a href="author/<?php echo $song->user_slug ?>"><?php echo $song->user_name ?></a></p>
                        <p class="meta"><i class="ion-ios-musical-notes"></i> <a href="genre/<?php echo $song->genre_slug ?>"><?php echo $song->genre_name ?></a></p>
                        <p class="meta">
                            <i class="ion-ios-calendar-outline"></i>
                            <?php if (date('Y', strtotime($song->created_at)) != date('Y')) : ?>
                                <?php echo date('M j Y', strtotime($song->created_at)); ?>
                            <?php else : ?>
                                <?php echo date('M j', strtotime($song->created_at)); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="media" ng-click="play('<?php echo $song->source_id ?>')">
                        <div class="aspect-ratio">
                            <img src="<?php echo $song->image_url ?>" alt="">
                        </div>
                    </div>
                </div>
                
            </article>

        <?php endforeach; ?>

        </section>

        <script src="//www.youtube.com/iframe_api"></script>
        <script src="//connect.soundcloud.com/sdk.js"></script>
        <script src="//w.soundcloud.com/player/api.js"></script>

        <script src="<?php echo base_url() ?>../bower_components/jquery/dist/jquery.js"></script>

        <script src="<?php echo base_url() ?>public/js/site/player.js"></script>
        <script src="<?php echo base_url() ?>public/js/site/site.js"></script>
        <script src="//localhost:35729/livereload.js"></script> 

    </body>
</html>