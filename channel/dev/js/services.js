'use strict';

app.factory('Api', function ($http, $q) {

    var url = function() {
        
        if (location.hostname == '127.0.0.1' || location.hostname == 'localhost') {
            var url = 'http://localhost:8888/channel-599/api/src';
        } else {
            var url = 'http://channel599.com/';
        }
        
        return url;

    }

    var get = function (route) {

        var deferred = $q.defer();

        // console.log(url() + route);

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

app.factory('Player', function ($http, $q, $rootScope) {

    var player;

    var set = function (newPlayer) {
        player = newPlayer;
        $rootScope.$broadcast('playerCreated', player);
    }

    var get = function () {
        return player;
    }

    var status = function (newStatus) {
        if (typeof player.status == 'undefined' || player.status != newStatus) {
            player.status = newStatus;
            $rootScope.$broadcast('playerStatusChange');
        }
    }

    return {
        set: set,
        get: get,
        status
    }

});

app.factory('Playlist', function ($http, $q) {

    var playList;

    var set = function (newPlayList) {
        playList = newPlayList;
    }

    var get = function () {
        return playList;
    }

    return {
        set: set,
        get: get
    }

});


