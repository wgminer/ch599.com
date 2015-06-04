'use strict';

app.controller('AdminCtrl', function ($scope, $location, Api) {

    Api.get('/songs?user_id=2')
        .then(function (callback) {
            $scope.songs = callback;
        }, function (error) {
            console.log(error);
        });

    Api.get('/genres')
        .then(function (callback) {
            $scope.genres = callback;
        }, function (error) {
            console.log(error);
        });

});

