'use strict';

_.mixin({templateFromUrl: function (url, data, settings) {
    

    return _.template(templateHtml, data, settings);
}});


var Playlist = (function () {

    var create = function ($wrapper, string) {

        var playlistHtml = '';
        var songs = JSON.parse(string);

        var url = 'templates/song.html';
        var templateHtml = '';
        this.cache = this.cache || {};

        if (this.cache[url]) {
            templateHtml = this.cache[url];
        } else {
            $.ajax({
                url: url,
                method: "GET",
                async: false,
                success: function(data) {
                    templateHtml = data;
                }
            });

            this.cache[url] = templateHtml;
        }

        _.each(songs, function (song) { 
            var songHtml = _.template(templateHtml);
            playlistHtml += songHtml(song); 
        });

        $wrapper[0].innerHTML = playlistHtml;
    }

    return {
        create: create
    }

})();