'use strict';

var Player = (function () {

    var module = {};

    var $playing = false;
    var $controls = false;
    var player = false;

    var updateControls = function () {
        
        $controls.removeClass('is--playing is--paused is--loading');

        if (player.status == 1) {
            $controls.addClass('is--paused');
        } else if (player.status == 2) {
            $controls.addClass('is--playing');
        } else {
            $controls.addClass('is--loading');
        }
    }

    module.play = function () {

        if ($playing) {
            if (player.source == 'youtube') {
                player.playVideo();
            } else {
                player.play();
            }
        } else {
            var $first = $('.song').first();
            if ($first) {
                module.create($first);
            }
        }

        
    }

    module.pause = function () {

        if (player.source == 'youtube') {
            player.pauseVideo();
        } else {
            player.pause();
        }
    }

    module.next = function () {

        if ($playing) {
            var $next = $playing.next('.song');

            if ($next) {
                module.create($next);
            }
        }
        
    }

    module.prev = function () {

        if ($playing) {
            var $prev = $playing.prev('.song');

            if ($prev) {
                module.create($prev);
            }
        }
    }

    module.toggle = function () {
        if ($playing) {

            if (player.status == 1) {
                module.pause();
            } else if (player.status == 2) {
                module.play();
            }
        }
    }

    module.seek = function ($annotation) {

        var timestamp = $annotation.data('timestamp');
        var source_id = $annotation.data('source-id');

        // console.log(player, player.source_id, source_id);

        if (player && player.source_id == source_id) {

            if (player.source == 'youtube') {
                timestamp = timestamp / 1000;
            }

            player.seekTo(timestamp);
            if (player.status != 1) {
                module.play();
            }
            
        } else {
            var $song = $annotation.parents('.song');
            module.create($song, timestamp);
        }
    }

    module.create = function ($song, seekTo) {

        var $media = $song.find('.song__media');

        var song = {
            source: $song.attr('source'),
            source_id: $song.attr('source-id'),
            source_url: $song.attr('source-url')
        }

        // console.log(song);

        if (typeof seekTo == 'undefined') {
            seekTo = 0;
        }

        if ($playing) {
            $playing.removeClass('is--playing').find('iframe').remove();
        }

        $song.addClass('is--playing');
        $playing = $song;
        
        if (song.source == 'youtube') {

            var $sacrifice = $('<div id="player"></div>');
            $media.prepend($sacrifice);
            
            player = new YT.Player('player', {
                videoId: song.source_id,
                playerVars: {
                    wmode: 'opaque',
                    showinfo: 0,
                    modestbranding: 1
                },
                events: {
                    onReady: function (event) {
                        event.target.playVideo();

                        if (seekTo > 0) {
                            event.target.seekTo(seekTo/1000);
                        }
                    },
                    onStateChange: function (event) {
                        player.status = event.data;
                        updateControls();
                        if (event.data == 0) {
                            module.next();
                        }
                    }
                }
            });

            player.source = song.source;
            player.source_id = song.source_id;
            player.source_url = song.source_url;

            player.status = 0;
            updateControls();

            // console.log(player);
            
        } else if (song.source == 'soundcloud') {

            var params = {
                show_comments: false,
                auto_play: true
            }

            SC.oEmbed(song.source_url, params, function(oembed){

                $media.prepend(oembed.html);

                player = SC.Widget($media.children()[0]);

                player.source = song.source;
                player.source_id = song.source_id;
                player.source_url = song.source_url;

                player.status = 0;
                updateControls();

                player.bind(SC.Widget.Events.READY, function(eventData) {
                    setTimeout(function(){
                        if (seekTo > 0) {
                            player.seekTo(seekTo);
                        }
                    }, 1000);
                });

                player.bind(SC.Widget.Events.PLAY, function(eventData) {
                    player.status = 1;
                    // console.log(player.status);
                    updateControls();
                });

                player.bind(SC.Widget.Events.PAUSE, function(eventData) {
                    player.status = 2;
                    // console.log(player.status);
                    updateControls();
                });

                player.bind(SC.Widget.Events.FINISH, function(eventData) {
                    player.status = 0;
                    module.next();
                });

            });

        }
    }

    module.init = function (controls) {
        $controls = controls;
    }
        
    return module;

})();