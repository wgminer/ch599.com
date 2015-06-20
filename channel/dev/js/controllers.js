'use strict';

app.controller('PlaylistCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    Api.get('/songs?status_id=1&offset=0&limit=50')
        .then(function (callback) {
            $scope.songs = callback;
        }, function (error) {
            console.log(error);
        });

});


