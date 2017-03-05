'use strict';

app.controller('ListCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    var init = function () {

        var path = $location.path();
        var status = 1;
        if (path == '/drafts') {
            status = 2;
        } else if (path == '/errors') {
            status = 3;
        }

        console.log(user.id, status);
        Api.get('/songs?user_id=' + user.id + '&status_id=' + status)
            .then(function (callback) {
                $scope.songs = callback;
            }, function (error) {
                console.log(error);
            });
    }

    init();
    
    $scope.$on('reload', function(event, args) {
        init();
    });

});

app.controller('SettingsCtrl', function ($scope, $rootScope, $location, Api) {

    Api.get('/users/' + user.id)
        .then(function (callback) {
            $scope.user = callback[0];
        }, function (error) {
            console.log(error);
        });

    $scope.updateUser = function (user) {
        console.log(user);
        Api.post('/users/update/' + user.id, angular.toJson(user))
            .then(function (callback) {
                $scope.user = callback;
                $scope.user.id = user.id;

                $rootScope.$broadcast('toast', {
                    message: 'Profile updated!', 
                    status: 'success'
                });
            }, function(error){
                console.log(error);
                $rootScope.$broadcast('toast', {
                    message: 'Something went wrong...', 
                    status: 'danger'
                });
            });
    }

    $scope.updatePassword = function (password) {
        Api.post('/users/update/password/' + $scope.user.id, angular.toJson(password))
            .then(function (callback) {
                $scope.password = '';
                $rootScope.$broadcast('toast', {
                    message: 'Password updated!', 
                    status: 'success'
                });
            }, function(error){
                console.log(error);
                $rootScope.$broadcast('toast', {
                    message: 'Something went wrong...', 
                    status: 'danger'
                });
            });
    }

});

app.controller('ResetCtrl', function ($scope, $rootScope, $location, Api) {

    Api.get('/users/' + user.id)
        .then(function (callback) {
            $scope.user = callback[0];
        }, function (error) {
            console.log(error);
        });

    $scope.save = function (user, password) {

        console.log(user, password);

        if (password && password.trim().length > 0) {

            Api.post('/users/update/' + user.id, angular.toJson(user))
                .then(function (callback) {

                    console.log(callback);

                    Api.post('/users/update/password/' + user.id, angular.toJson(password))
                        .then(function (callback) {
                            console.log(callback);
                            window.location.href = baseUrl + 'milagro';
                        }, function(error){
                            console.log(error);
                        });

                }, function(error){
                    console.log(error);
                });

        } else {
            $rootScope.$broadcast('toast', {
                message: 'Set a valid password!', 
                status: 'danger'
            });
        }
        
    }

});

