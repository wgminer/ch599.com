'use strict';

angular
    .module('channel599', [
        'ngRoute',
        'angularMoment'
    ])
    .run(function ($rootScope) {
        $rootScope.message = 'YOLO World';
    })
    .constant('angularMomentConfig', {
        preprocess: 'utc'
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

    });