'use strict';

angular
    .module('channel599', [
        'ngRoute',
        'ngAnimate',
        'ngResource'
    ])
    .config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'views/main.html',
                controller: 'MainCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });
    });
