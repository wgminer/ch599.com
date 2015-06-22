'use strict';

var app = angular.module('channel599', [
    'ngRoute',
    'angularMoment'
]);

app.constant('angularMomentConfig', {
    preprocess: 'utc'
});

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/playlist.html',
            controller: 'PlaylistCtrl',
        })
        .when('/:slug', {
            templateUrl: 'views/song.html',
            controller: 'SongCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});

app.run();
