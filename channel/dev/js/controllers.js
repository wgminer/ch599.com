'use strict';

app.controller('MainCtrl', function ($scope, $rootScope, $routeParams, $location, Api) {
    
    $scope.songs = [];

    var offset = 0;

    var fetchSongs = function (offset) {
        var url = '/songs?status_id=1&limit=50&formatted=true&offset=' + offset;
        Api.get(url)
            .then(function (callback) {
                $rootScope.$broadcast('playlistLoaded');
                $scope.songs = $scope.songs.concat(callback);
            }, function (error) {
                console.log(error);
            });
    }

    var init = function () {
        fetchSongs(offset);
    }
    
    init();

});

app.controller('AuthorCtrl', function ($scope, $routeParams, $location, Api) {

    $scope.user = {};
    $scope.songs = [];

    var offset = 0;

    var fetchSongs = function (offset) {
        var url = '/songs?status_id=1&limit=50&formatted=true&offset=' + offset + '&user_id=' + $scope.user.id;
        Api.get(url)
            .then(function (callback) {
                $scope.songs = $scope.songs.concat(callback);
            }, function (error) {
                console.log(error);
            });
    }

    var init = function () {
        Api.get('/users')
            .then(function (callback) {
                $scope.user = _.findWhere(callback, {'slug': $routeParams.slug});
                fetchSongs(offset, $scope.user.id);
            }, function (error) {
                console.log(error);
            });
    }

    init();
 
});

app.controller('GenreCtrl', function ($scope, $location, Api) {

    $scope.user = {};
    $scope.songs = [];

    var offset = 0;

    var fetchSongs = function (offset) {
        var url = '/songs?status_id=1&limit=50&formatted=true&offset=' + offset + '&user_id=' + $scope.user.id;
        Api.get(url)
            .then(function (callback) {
                $scope.songs = $scope.songs.concat(callback);
            }, function (error) {
                console.log(error);
            });
    }

    var init = function () {
        Api.get('/users')
            .then(function (callback) {
                $scope.user = _.findWhere(users, {'slug': $routeParams.slug});
                fetchSongs(offset, $scope.user.id);
            }, function (error) {
                console.log(error);
            });
    }

});

app.controller('SongCtrl', function ($scope, $location, Api) {


});


