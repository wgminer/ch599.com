'use strict';

app.factory('Api', function ($http, $q) {

    var url = function() {
        
        if (location.hostname == '127.0.0.1' || location.hostname == 'localhost') {
            var url = 'http://localhost:8888/channel-599/api';
        } else {
            var url = 'http://channel599.com/';
        }
        
        return url;

    }

    var get = function (route) {

        var deferred = $q.defer();

        $http.get(url() + route)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(error){
                deferred.reject(error);
            });

        return deferred.promise;

    }

    var post = function (route, data) {

        var deferred = $q.defer();

        $http.post(url() + route, data)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(error){
                deferred.reject(error);
            });

        return deferred.promise;

    }

    // Public API

    return {
        get: get,
        post: post
    }

});

app.factory('YouTube', function ($http, $q) {

    var ytAPIKey = 'AIzaSyByLHiwIljNcIO7sSuhTT22RsnhDHg2X8c';

    var newYTSong = function(url) {

        if (url.lastIndexOf('?v=') > -1) {
            var start = url.lastIndexOf('?v=') + 3;
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

                if (data.items[0].snippet.thumbnails.maxres) {
                    var imageUrl = data.items[0].snippet.thumbnails.maxres.url;
                } else if (data.items[0].snippet.thumbnails.high) {
                    var imageUrl = data.items[0].snippet.thumbnails.high.url;
                } else {
                    var imageUrl = data.items[0].snippet.thumbnails.default.url;
                }

                var newSong = {
                    title: data.items[0].snippet.title,
                    image_url: imageUrl,
                    source: 'youtube',
                    source_id: data.items[0].id,
                    source_url: 'https://www.youtube.com/watch?v='+data.items[0].id
                }
                deferred.resolve(newSong);
            })
            .error(function(){
                deferred.reject();
            });

        return deferred.promise;

    }

    return {
        newYTSong: newYTSong
    }

});

app.factory('SoundCloud', function ($http, $q) {

    var newSCSong = function(url) {

        SC.initialize({
            client_id: 'e58c01b67bbc39c365f87269b927a868'
        });

        var deferred = $q.defer();

        SC.get('/resolve', { url: url }, function(data) {

            if (data.embeddable_by != 'me') {

                if (data.artwork_url) {
                    var image = data.artwork_url;
                } else {
                    var image = data.user.avatar_url;
                }
                    
                var newSong = {
                    title: data.title,
                    image_url: image.replace('large', 't500x500'),
                    source: 'soundcloud',
                    source_id: data.id,
                    source_url: data.permalink_url,
                }
                deferred.resolve(newSong);

            } else {
                deferred.resolve(false);
            }

        });

        return deferred.promise;

    }

    return {
        newSCSong: newSCSong
    }

});