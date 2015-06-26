'use strict';

app.controller('PlaylistCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    Api.get('/songs?status_id=1&offset=0&limit=50&formatted=true')
        .then(function (callback) {
            $scope.songs = callback;
        }, function (error) {
            console.log(error);
        });

});


app.controller('SongCtrl', function ($scope, $rootScope, $location, $routeParams, Api, YouTube, SoundCloud) {

    $('.masthead').addClass('masthead--mini');
    $('.player').addClass('player--playing');
    $('.bar').addClass('bar--dark');

    if (!$rootScope.playing) {

        Api.get('/songs?slug=' + $routeParams.slug + '&formatted=true')
            .then(function (callback) {
                $rootScope.playing = callback[0];
                if ($rootScope.playing.source == 'youtube') {
                    $('iframe').attr('src',  'https://www.youtube.com/embed/' + $rootScope.playing.source_id + '?autoplay=1');
                } else {
                    $('iframe').attr('src',  'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' + $rootScope.playing.source_id + '&auto_play=true&hide_related=true&show_comments=false&show_user=true&show_reposts=false&visual=true');
                }
            }, function (error) {
                console.log(error);
            });

    } else {
        if ($rootScope.playing.source == 'youtube') {
            $('iframe').attr('src',  'https://www.youtube.com/embed/' + $rootScope.playing.source_id + '?autoplay=1');
        } else {
            $('iframe').attr('src',  'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' + $rootScope.playing.source_id + '&auto_play=true&hide_related=true&show_comments=false&show_user=true&show_reposts=false&visual=true');
        }
    }

});


