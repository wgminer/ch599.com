'use strict';

var app = angular.module('admin599', [
    'ngRoute'
]);

app.run();

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'public/admin/views/list.html',
            controller: 'ListCtrl',
        })
        .when('/profile', {
            templateUrl: 'public/admin/views/profile.html',
            controller: 'ProfileCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});
