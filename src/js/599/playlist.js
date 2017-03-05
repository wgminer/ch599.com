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
            $('.feed img.lazy').lazyload().removeClass('lazy');
            offset+=increment;
        });
    }

    module.error = function (img) {

        // This is the dimension of the broken YT thumbnail
        if (img.naturalHeight == 90 && img.naturalWidth == 120) {
            $(img).parents('.song').hide();
        }
    }

    module.init = function (playlist) {
        $playlist = playlist;
    }
        
    return module;

})();