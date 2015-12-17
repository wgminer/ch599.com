'use strict';

app.controller('MainCtrl', function ($scope, $rootScope, $routeParams, $location, Api) {
    $scope.baseUrl = '/songs?status_id=1&formatted=true';
});

app.controller('AuthorCtrl', function ($scope, $routeParams, $location, Api) {
    $scope.baseUrl = '/songs?status_id=1&formatted=true&user_slug=' + $routeParams.slug;
});

app.controller('GenreCtrl', function ($scope, $location, Api) {
    $scope.baseUrl = '/songs?status_id=1&formatted=true&genre_slug=' + $routeParams.slug;
});

app.controller('SongCtrl', function ($scope, $location, Api) {


});


