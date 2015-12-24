'use strict';

app.controller('ListCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

    Api.get('/statuses')
        .then(function (callback) {
            $scope.statuses = callback;
        }, function (error) {
            console.log(error);
        });

    Api.get('/genres')
        .then(function (callback) {
            $scope.genres = callback;
        }, function (error) {
            console.log(error);
        });

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

    $scope.toggleModal = function (event, elementClass) {
        if (event && elementClass) {
            if (event.target.className == elementClass) {
                $rootScope.modalOpen = !$rootScope.modalOpen;
            }
        } else {
            $scope.preview = {status_id: '1'};
            $rootScope.modalOpen = !$rootScope.modalOpen;
        }
    }

    $scope.editSong = function (song, index) {
        $rootScope.modalOpen = true;
        $scope.preview = angular.copy(song);
        $scope.preview.$index = index;
    }

    $scope.submit = function (song) {
        Api.post('/songs/create', angular.toJson(song))
            .then(function (callback) {

                if (callback.status_id == 1) {
                    $scope.published.unshift(callback);
                } else if (callback.status_id == 2) {
                    $scope.draft.unshift(callback);
                }

                $scope.visibleList = callback.status_id;   
                $rootScope.modalOpen = false;

            }, function(error){
                console.log(error);
            });
    }

    $scope.update = function (song, index) {
        console.log(song, index);
        Api.post('/songs/update/' + song.id, angular.toJson(song))
            .then(function (callback) {

                initLists();
                $scope.visibleList = callback.status_id;                
                $rootScope.modalOpen = false;

            }, function(error){
                console.log(error);
            });
    }

    var createPreview = function (post) {
        $scope.preview.image_url = post.image_url;
        $scope.preview.source = post.source;
        $scope.preview.source_id = post.source_id;
        $scope.preview.source_url = post.source_url;

        if (!$scope.preview.title) {
            $scope.preview.title = post.title;
        }
    }

    $scope.previewSong = function (url) {
        var keepTitle = false;
        if (url != '') {
            if (url.indexOf('youtu') > -1) {
                YouTube.newYTSong(url)
                    .then(function (callback) {
                        createPreview(callback);
                    }, function (error) {
                        console.log(error);
                    });
            } else if (url.indexOf('soundcloud') > -1) {
                SoundCloud.newSCSong(url)
                    .then(function (callback) {
                        createPreview(callback);
                    }, function (error) {
                        console.log(error);
                    });
            }
        }
    }

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


