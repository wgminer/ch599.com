'use strict';

angular.module('channel599')
    .controller('DashboardCtrl', function ($scope, $rootScope, $location, Api, YouTube, SoundCloud) {

        $rootScope.currentRoute = 'dashboard';
        $rootScope.previewView = 'details';

        Api.get('/songs?user_id=1')
            .then(function (callback) {
                console.log(callback);
                $scope.songs = callback;
            }, function (error) {
                console.log(error);
            });

        Api.get('/genres')
            .then(function (callback) {
                $scope.genres = callback;
            }, function (error) {
                console.log(error);
            })

        var previewedIndex = 0;

        var setAnnotations = function () {
            if (!$scope.preview.annotations) {
                $scope.preview.annotations = [{}, {}, {}];
            } else if ($scope.preview.annotations.length == 1) {
                $scope.preview.annotations.push({}, {});
            } else if ($scope.preview.annotations.length == 2) {
                $scope.preview.annotations.push({});
            }
        }

        var parseTimestamp = function (time) {
            var seconds = time.substring(time.length, time.length - 2);
            var minutes = time.substring(time.length - 3, time.length - 5);
            var hours = time.substring(0, time.length - 6);

            seconds = parseInt(seconds);
            minutes = parseInt(minutes);
            hours = parseInt(hours);

            if (isNaN(seconds)) {
                seconds = 0;
            }

            if (isNaN(minutes)) {
                minutes = 0;
            }

            if (isNaN(hours)) {
                hours = 0;
            }

            var timestamp = (hours * 60 * 60 * 1000) + (minutes * 60 * 1000) + (seconds * 1000);
            
            return timestamp;
        }

        $scope.preview = {};
        setAnnotations();

        $scope.newSong = function () {
            $scope.preview = {};
            setAnnotations();
        }

        $scope.setPreviewSong = function (song, index) {
            previewedIndex = index;
            $scope.previewedSong = song;
            $scope.preview = angular.copy(song);
            setAnnotations();
            console.log($scope.preview);
        }

        $scope.postAction = function (song) {

            if (song.annotations && song.annotations.length > 0) {
                for (var i = 0; i < song.annotations.length; i++) {
                    if (typeof song.annotations[i].time != 'undefined') {
                        song.annotations[i].timestamp = parseTimestamp(song.annotations[i].time);
                    }
                }
            }

            console.log(song);

            if (!song.status_id) {
                Api.post('/songs/create', angular.toJson(song))
                    .then(function(callback){
                        console.log(callback);
                        $scope.preview = {};
                        setAnnotations();
                        $scope.songs.unshift(callback);                          
                    }, function(error){
                        console.log(error);
                    });
            } else {
                Api.post('/songs/update/' + song.id, angular.toJson(song))
                    .then(function(){
                        $scope.songs[previewedIndex] = song;
                        $scope.previewedSong = song;
                        $scope.preview = angular.copy(song);                         
                    }, function(error){
                        console.log(error);
                    });
            }
        }

        $scope.previewSong = function (url) {

            if (url != '') {
                if (url.indexOf('youtu') > -1) {
                    YouTube.newYTSong(url)
                        .then(function (preview) {
                            $scope.preview.title = preview.title;
                            $scope.preview.image_url = preview.image_url;
                            $scope.preview.source = preview.source;
                            $scope.preview.source_id = preview.source_id;
                            $scope.preview.source_url = preview.source_url;
                        }, function (error) {
                            console.log(error);
                        });
                } else if (url.indexOf('soundcloud') > -1) {
                    SoundCloud.newSCSong(url)
                        .then(function (preview) {
                            $scope.preview.title = preview.title;
                            $scope.preview.image_url = preview.image_url;
                            $scope.preview.source = preview.source;
                            $scope.preview.source_id = preview.source_id;
                            $scope.preview.source_url = preview.source_url;
                        }, function (error) {
                            console.log(error);
                        });
                }
            }
        }
        
    })
    .controller('SettingsCtrl', function ($scope, $rootScope, $location, Api) {

        $rootScope.currentRoute = 'settings';

    });