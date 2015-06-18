'use strict';

var app = angular.module('admin599', [
    'ngRoute'
]);

app.run();

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/list.html',
            controller: 'ListCtrl',
        })
        .when('/new', {
            templateUrl: 'views/new.html',
            controller: 'NewCtrl',
        })
        .when('/profile', {
            templateUrl: 'views/profile.html',
            controller: 'ProfileCtrl',
        })
        .when('/edit/:id', {
            templateUrl: 'views/edit.html',
            controller: 'EditCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});
