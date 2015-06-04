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

app.factory('Auth', function ($q, $interval) {


});