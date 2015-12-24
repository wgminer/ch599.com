'use strict';

app.controller('ListCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    var path = $location.path();
    var status = 1;
    if (path == '/drafts') {
        status = 2;
    } else if (path == '/errors') {
        status = 3;
    }

    Api.get('/songs?user_id=' + user.id + '&status_id=' + status)
        .then(function (callback) {
            $scope.songs = callback;
        }, function (error) {
            console.log(error);
        });

    $scope.visibleList = 1;
    $rootScope.modalOpen = false;

});

app.controller('SettingsCtrl', function ($scope, $location, Api) {

    Api.get('/users/' + '2')
        .then(function (callback) {
            $scope.user = callback[0];
        }, function (error) {
            console.log(error);
        });

    $scope.updateUser = function (user) {
        console.log(user);
        Api.post('/users/update/' + user.id, angular.toJson(user))
            .then(function (callback) {
                console.log(callback);
                $scope.user = callback;
            }, function(error){
                console.log(error);
            });
    }

    $scope.updatePassword = function (password) {
        Api.post('/users/update/password/' + $scope.user.id, angular.toJson(password))
            .then(function (callback) {
                console.log(callback);
                $scope.password = {'new': ''}
            }, function(error){
                console.log(error);
            });
    }

});

app.controller('ModalCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

})


