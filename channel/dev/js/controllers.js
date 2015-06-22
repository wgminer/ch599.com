'use strict';

app.controller('PlaylistCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    $('.player').removeClass('player--playing');

    Api.get('/songs?status_id=1&offset=0&limit=50&formatted=true')
        .then(function (callback) {
            $scope.songs = callback;
        }, function (error) {
            console.log(error);
        });

});


app.controller('SongCtrl', function ($scope, $rootScope, $location, $routeParams, Api, YouTube, SoundCloud) {

    $('.player').addClass('player--playing');

    if (!$rootScope.playing) {

        Api.get('/songs?slug=' + $routeParams.slug + '&formatted=true')
            .then(function (callback) {
                $rootScope.playing = callback[0];
                $('iframe').attr('src',  'https://www.youtube.com/embed/' + $rootScope.playing.source_id + '?autoplay=1');
            }, function (error) {
                console.log(error);
            });

    } else {
        $('iframe').attr('src',  'https://www.youtube.com/embed/' + $rootScope.playing.source_id + '?autoplay=1');
    }

});


