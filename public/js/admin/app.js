'use strict';

var app = angular.module('599', ['ngRoute']);

app.run();

app.config(function ($routeProvider) {
    $routeProvider
        .when('/published', {
            templateUrl: baseUrl + '/public/partials/list.html',
            controller: 'ListCtrl',
        })
        .when('/drafts', {
            templateUrl: baseUrl + '/public/partials/list.html',
            controller: 'ListCtrl',
        })
        .when('/errors', {
            templateUrl: baseUrl + '/public/partials/list.html',
            controller: 'ListCtrl',
        })
        .otherwise({
            redirectTo: '/published'
        });
});