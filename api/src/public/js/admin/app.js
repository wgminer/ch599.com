'use strict';

angular
    .module('channel599', [
        'ngRoute'
    ])
    .run(function ($rootScope) {
        $rootScope.message = 'YOLO World';
    })
    .config(function ($routeProvider, $locationProvider) {

        $routeProvider
            .when('/', {
                templateUrl: 'public/views/dashboard.html',
                controller: 'DashboardCtrl',
            })
            .when('/settings', {
                templateUrl: 'public/views/settings.html',
                controller: 'SettingsCtrl',
            })
            .otherwise({
                redirectTo: '/'
            });

    })