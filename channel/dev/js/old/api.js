'use strict';

var Api = (function () {

    var url = function() {
        if (location.hostname == '127.0.0.1' || location.hostname == 'localhost') {
            var url = 'http://localhost:8888/channel-599/api/src';
        } else {
            var url = 'http://channel599.com/';
        }
        return url;
    }

    var get = function (route) {
        return $.get(url() + route);
    }

    var post = function (route, data) {
        return $.post(url() + route, data)
    }

    return {
        get: get,
        post: post
    }

})();