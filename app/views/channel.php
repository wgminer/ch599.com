<!DOCTYPE html>
<html ng-app="channel599">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Channel 599</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href="/channel-599/">
        
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 

        <script src="//use.typekit.net/owf6hsl.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>

        <link rel="stylesheet" href="<?php echo base_url() ?>/public/channel/css/main.css">
    </head>
    <body player>

        <header class="masthead">
            <div class="masthead__container">
                <h1 class="masthead__title"><a href="#/">Channel 599</a></h1>
            </div>
        </header>

        <div class="view" ng-view="" autoscroll=""></div>

        <div class="player"></div>
        
        <script src="//www.youtube.com/iframe_api"></script>
        <script src="//connect.soundcloud.com/sdk.js"></script>
        <script src="//w.soundcloud.com/player/api.js"></script>

        <script src="<?php echo base_url() ?>bower_components/jquery/dist/jquery.js"></script>
        <script src="<?php echo base_url() ?>bower_components/moment/moment.js"></script>
        <script src="<?php echo base_url() ?>bower_components/underscore/underscore.js"></script>

        <script src="<?php echo base_url() ?>bower_components/angular/angular.js"></script>
        <script src="<?php echo base_url() ?>bower_components/angular-route/angular-route.js"></script>
        <script src="<?php echo base_url() ?>bower_components/angular-moment/angular-moment.js"></script>
        <script src="<?php echo base_url() ?>bower_components/angular-underscore/angular-underscore.js"></script>

        <script src="<?php echo base_url() ?>public/channel/js/app.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/controllers.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/directives.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/services.js"></script>

        <script src="//localhost:35729/livereload.js"></script> 

    </body>
</html>