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

        <div class="bar" ng-class="{'bar--open': showFilters || showSearch}">
            <a class="bar__title" href="latest">Latest</a>
            <div class="controls controls--navigation controls--show">
                <button ng-click="toggleFilters()" id="filters" class="controls__button"><i class="ion-ios-settings"></i></button>
                <!-- <button ng-click="toggleSearch()" id="search" class="controls__button"><i class="ion-ios-search"></i></button> -->
            </div>
            <div class="controls controls--player" ng-class="{'controls--show': showControls}">
                <button id="previous" ng-click="prev()" class="controls__button"><i class="ion-ios-arrow-up"></i></button>
                <button id="play" ng-show="player.status == 2" ng-click="play()" class="controls__button"><i class="ion-ios-play"></i></button>
                <button id="pause" ng-show="player.status == 1" ng-click="pause()" class="controls__button"><i class="ion-ios-pause"></i></button>
                <button id="loading" ng-show="player.status != 1 && player.status != 2" class="controls__button"><i class="ion-ios-loop-strong"></i></button>
                <button id="next" ng-click="next()" class="controls__button"><i class="ion-ios-arrow-down"></i></button>
            </div>
            <div class="filters bar__page" ng-class="{'bar__page--show': showFilters}">
                <ul class="list">
                    <li class="list__title">Authors</li>
                    <li class="list__item" ng-repeat="user in users"><a class="list__link" ng-hide="$index == 0" href="author/{{user.slug}}">{{user.name}}</a></li>
                </ul>
            </div>
            <div class="search bar__page" ng-class="{'bar__page--show': showSearch}"></div>
        </div>

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

        <script src="<?php echo base_url() ?>public/channel/js/app.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/controllers.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/directives.js"></script>
        <script src="<?php echo base_url() ?>public/channel/js/services.js"></script>

        <script src="//localhost:35729/livereload.js"></script> 

    </body>
</html>