'use strict';

app.controller('ListCtrl', function ($scope, $location, Api) {

    Api.get('/songs?user_id=5&status_id=1')
        .then(function (callback) {
            $scope.published = callback;
        }, function (error) {
            console.log(error);
        });

    Api.get('/songs?user_id=5&status_id=2')
        .then(function (callback) {
            $scope.draft = callback;
            console.log(callback);
        }, function (error) {
            console.log(error);
        });

    Api.get('/songs?user_id=5&status_id=3')
        .then(function (callback) {
            $scope.error = callback;
            console.log(callback);
        }, function (error) {
            console.log(error);
        });

    $scope.visibleList = 1;

});

app.controller('NewCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

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

    $scope.preview = {status_id: '1'};

    $scope.reset = function () {
        $scope.preview = {status_id: '1'};
    }

    $scope.submit = function (song) {

        Api.post('/songs/create', angular.toJson(song))
            .then(function(callback){
                console.log(callback);
                $location.path('/');
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

})

app.controller('ProfileCtrl', function ($scope, $location, Api) {


});

app.controller('EditCtrl', function ($scope, $location, Api) {

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

    $scope.preview = {status_id: 1};
    $scope.newSong = function () {
        $scope.preview = {status_id: 1};
    }

    $scope.submit = function (song) {

        if (song.annotations && song.annotations.length > 0) {
            for (var i = 0; i < song.annotations.length; i++) {
                if (typeof song.annotations[i].time != 'undefined') {
                    song.annotations[i].timestamp = parseTimestamp(song.annotations[i].time);
                }
            }
        }

        Api.post('/songs/update/' + song.id, angular.toJson(song))
            .then(function(){
                $scope.songs[previewedIndex] = song;
                $scope.previewedSong = song;
                $scope.preview = angular.copy(song);                         
            }, function(error){
                console.log(error);
            });
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


