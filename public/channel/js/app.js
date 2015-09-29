'use strict';

var app = angular.module('channel599', [
    'ngRoute',
    'angularMoment'
]);

app.constant('angularMomentConfig', {
    preprocess: 'utc'
});

app.run(function ($rootScope, Api) {
    Api.get('/users')
        .then(function (callback) {
            $rootScope.users = callback;
        }, function (error) {
            console.log(error);
        });
    });

app.config(function ($routeProvider, $locationProvider) {
    
    $routeProvider
        .when('/latest', {
            templateUrl: 'public/channel/views/playlist.html',
            controller: 'MainCtrl',
        })
        .when('/author/:slug', {
            templateUrl: 'public/channel/views/playlist.html',
            controller: 'AuthorCtrl',
        })
        .when('/genre/:slug', {
            templateUrl: 'public/channel/views/playlist.html',
            controller: 'GenreCtrl',
        })
        .when('/:slug', {
            templateUrl: 'public/channel/views/song.html',
            controller: 'SongCtrl',
        })
        .otherwise({
            redirectTo: '/latest'
        });

    // use the HTML5 History API
    $locationProvider.html5Mode(true);

});
