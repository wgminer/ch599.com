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
            controller: 'MainCtrl',
        })
        .when('/author/:slug', {
            templateUrl: 'views/playlist.html',
            controller: 'AuthorCtrl',
        })
        .when('/genre/:slug', {
            templateUrl: 'views/playlist.html',
            controller: 'GenreCtrl',
        })
        .when('/:slug', {
            templateUrl: 'views/song.html',
            controller: 'SongCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});
