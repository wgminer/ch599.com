'use strict';

var Playlist = (function () {

    var module = {};
    var $playlist;
    var increment = 50;
    var offset = increment;
    var href = window.location.href;

    module.paginate = function ($button) {
        $button.text('Loading');
        var url = window.location.href + '?offset=' + offset + '?&ajax=true';
        $.get(url, function (html) {
            $playlist.append(html);
            $button.text('Moar');
            offset+=increment;
        });
    }

    module.init = function (playlist) {
        console.log();
        $playlist = playlist;
    }
        
    return module;

})();