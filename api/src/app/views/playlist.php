<!doctype html>
<html class="no-js" ng-app="channel599">
    <?php $this->load->view('includes/head.site.php'); ?>
    <body class="site faded" ng-controller="PlaylistCtrl">

        <div class="controls">
            <button id="previous"><i class="ion-ios-skipbackward"></i></button>
            <button id="play"><i class="ion-ios-play"></i></button>
            <button id="pause"><i class="ion-ios-pause"></i></button>
            <button id="loading"><i class="ion-ios-loop-strong"></i></button>
            <button id="next"><i class="ion-ios-skipforward"></i></button>
        </div>

        <header class="masthead">
            <div class="title">
                <h1><a href="">599</a></h1>
            </div>
            <div class="links">
                <p>You're on Channel 599,<br>a music blog started in Rob's room in 2010.</p>
                <nav>
                    <a href="">Latest</a>
                    <a href="">Search</a>
                    <a href="">Archive</a>
                </nav> 
            </div>
        </header>

        <section class="playlist">

        <?php $this->load->view('includes/songs.php'); ?>

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