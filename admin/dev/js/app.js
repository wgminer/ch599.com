'use strict';

var app = angular.module('admin599', [
    'ngRoute'
]);

app.run();

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/admin.html',
            controller: 'AdminCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
});
