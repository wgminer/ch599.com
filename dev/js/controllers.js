'use strict';

angular.module('channel599')

    .controller('PlaylistCtrl', function ($scope, $rootScope, Player, YoutubeAPI, SoundCloudAPI) {

        // MOCKUP STUFF

        console.log($scope);

        $scope.playSong = function (data) {
            
        }

        $scope.addSong = function(url) {

            if (!$scope.addingSong) {

                if (url == undefined){

                    alert('Don\'t leave it blank!');
                    $scope.addingSong = false;

                } else if (url.indexOf('youtu') > -1) {

                    YoutubeAPI.getYTSongData(url)
                        .then(function(data){

                            if (data.items[0].snippet.thumbnails.maxres) {
                                var imageUrl = data.items[0].snippet.thumbnails.maxres.url;
                            } else {
                                var imageUrl = data.items[0].snippet.thumbnails.high.url;
                            }

                            var newSong = {
                                title: data.items[0].snippet.title,
                                image: imageUrl,
                                url: 'https://www.youtube.com/watch?v='+data.items[0].id,
                                source: 'youtube',
                                sourceId: data.items[0].id,
                                author: 'Will',
                                authorId: 1

                            }

                            $scope.playlist.songs.unshift(newSong);
    
                        }, function(error){
                            console.log(error);
                            alert('Something went wrong');
                        });

                } else if (url.indexOf('soundcloud') > -1) {

                    SoundCloudAPI.getSCSongData(url)
                        .then(function(data){

                            if (data.artwork_url) {
                                var image = data.artwork_url;
                            } else {
                                var image = data.user.avatar_url;
                            }

                            var newSong = {
                                title: data.title,
                                image: image.replace('large', 't500x500'),
                                url: data.permalink_url,
                                source: 'soundcloud',
                                sourceId: data.id,
                                author: 'Will',
                                authorId: 1
                            }

                            $scope.playlist.songs.unshift(newSong);
                            
                        }, function(error){
                            console.log(error);
                            alert('Something went wrong');
                        });

                } else {
                    alert('Not a valid source');
                }

            }

        }

        $rootScope.playlist = {
            "songs": [
                {   
                  "title": "Michael Jackson - Slave to the Rhythm (Audien Remix)",
                  "image": "https://i.ytimg.com/vi/YmaFPvdyUYo/maxresdefault.jpg",
                  "url": "https://www.youtube.com/watch?v=YmaFPvdyUYo",
                  "source": "youtube",
                  "sourceId": "YmaFPvdyUYo",
                  "author": "Will",
                  "authorId": 1
                },
                {
                  "title": "Audien vs Krewella - Iris Alive (Myon & Shane 54 Mashup)",
                  "image": "https://i.ytimg.com/vi/PIZ9OmTa2SM/maxresdefault.jpg",
                  "url": "https://www.youtube.com/watch?v=PIZ9OmTa2SM",
                  "source": "youtube",
                  "sourceId": "PIZ9OmTa2SM",
                  "author": "Will",
                  "authorId": 1
                },
                {
                  "title": "Michael Jackson - Slave to the Rhythm (Audien Remix)",
                  "image": "https://i.ytimg.com/vi/YmaFPvdyUYo/maxresdefault.jpg",
                  "url": "https://www.youtube.com/watch?v=YmaFPvdyUYo",
                  "source": "youtube",
                  "sourceId": "YmaFPvdyUYo",
                  "author": "Will",
                  "authorId": 1
                },
                {
                  "title": "Audien - Beyond Wonderland 2014",
                  "image": "https://i1.sndcdn.com/artworks-000092203361-86pf78-t500x500.jpg?debc7fd",
                  "url": "http://soundcloud.com/audien/audien-beyond-wonderland-2014",
                  "source": "soundcloud",
                  "sourceId": 169483801,
                  "author": "Will",
                  "authorId": 1
                },
                {
                  "title": "Maethelvin - Delight",
                  "image": "https://i.ytimg.com/vi/aFbmQkTBulQ/hqdefault.jpg",
                  "url": "https://www.youtube.com/watch?v=aFbmQkTBulQ",
                  "source": "youtube",
                  "sourceId": "aFbmQkTBulQ",
                  "author": "Will",
                  "authorId": 1
                }
            ]
        }

    });

