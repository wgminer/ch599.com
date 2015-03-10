'use strict';

angular.module('channel599')

    .factory('Player', function ($rootScope) {

        var player = false;

        return {
            set: function (newPlayer) {
                player = newPlayer;
                $rootScope.$broadcast('player:changed', player);
            },
            get: function () {
                return player;
            },
            change: function (obj, change) {
                player[obj] = change;
                $rootScope.$broadcast('player:changed', player);
            }
        };

    })

    .factory('YoutubeAPI', function ($http, $q) {

        var ytAPIKey = 'AIzaSyCkoszshUaUgV-2CrviQI0I4pTkd8j61gc';

        /**
         * Grab song data fron YT api
         * @param  {string} url
         * @return {object}
         */
        var getYTSongData = function(url) {

            console.log('calling');

            // Check if it's a full youtube URL
            if (url.lastIndexOf('?v=') > -1) {
                var start = url.lastIndexOf('?v=') + 3;

            // Else check if it's a shared URL
            } else if (url.lastIndexOf('.be/') > -1) {
                var start = url.lastIndexOf('.be/') + 4;
            } else {
                return 'error!';
            }

            var ytID = url.substring(start, start+11);
            var url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='+ytID+'&key='+ytAPIKey;
            var deferred = $q.defer();

            $http.get(url)
                .success(function(data){
                    console.log('done');
                    deferred.resolve(data);
                })
                .error(function(){
                    deferred.reject();
                });

            return deferred.promise;

        }

        return {
            getYTSongData: getYTSongData
        }

    })

    .factory('SoundCloudAPI', function ($http, $q) {

        var scAPIKey = 'e0ac220c7f34ae5602f816d9b51e12e3';

        /**
         * Get song data from SC
         * @param  {string} url
         * @return {object}
         */
        var getSCSongData = function(url) {

            SC.initialize({
                client_id: scAPIKey
            });

            var deferred = $q.defer();

            SC.get('/resolve', { url: url }, function(data) {
                
                deferred.resolve(data);

            });

            return deferred.promise;

        }

        return {
            getSCSongData: getSCSongData
        }

    });