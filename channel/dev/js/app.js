'use strict';

var app = angular.module('channel599', [
    'ngRoute'
]);

app.run();

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/playlist.html',
            controller: 'PlaylistCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});
