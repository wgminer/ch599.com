'use strict';

var Player = function () {

    var $playing = false;
    var $controls = false;
    var player = false;
    var $player = $('.player');

    var updateControls = function () {
        $controls.removeClass('controls--playing controls--paused controls--loading');
        $controls.addClass('controls--show');
        if (player.status == 1) {
            $controls.addClass('controls--playing');
        } else if (player.status == 2) {
            $controls.addClass('controls--paused');
        } else {
            $controls.addClass('controls--loading');
        }
    }

    var positionPlayer = function () {

        var $media = $playing.find('.song__media');

        var top = $media.offset().top;
        var left = $media.offset().left;
        var width =  $media.width();
        var height =  $media.height();

        $player.css({
            top: top,
            left: left,
            width: width,
            height: height
        });
    }

    return {
        play: function () {

            if (player.source == 'youtube') {
                player.playVideo();
            } else {
                player.play();
            }
        },
        pause: function () {

            if (player.source == 'youtube') {
                player.pauseVideo();
            } else {
                player.pause();
            }
        },
        next: function () {

            if ($playing) {
                var $next = $playing.next('.song');

                if ($next) {
                    console.log($next);
                    this.create($next);
                }
            }
            
        },
        previous: function () {

        },
        seek: function ($annotation) {

            var timestamp = $annotation.data('timestamp');
            var source_id = $annotation.data('source-id');

            console.log(player, player.source_id, source_id);

            if (player && player.source_id == source_id) {

                if (player.source == 'youtube') {
                    timestamp = timestamp / 1000;
                }

                player.seekTo(timestamp);
                if (player.status != 1) {
                    this.play();
                }
                
            } else {

                var $song = $annotation.parents('.song');

                this.create($song, timestamp);
            }
        },
        create: function ($song, seekTo) {

            var $media = $song.find('.song__media');
            var song = {
                source: $song.data('source'),
                source_id: $song.data('source-id'),
                source_url: $song.data('source-url')
            }

            if (typeof seekTo == 'undefined') {
                seekTo = 0;
            }

            if ($playing) {
                $playing.removeClass('song--playing');
                $player.removeClass('player--playing').find('iframe').remove();
            }

            $song.addClass('song--playing');
            $playing = $song;
            
            if (song.source == 'youtube') {

                var $sacrifice = $('<div id="player"></div>');
                $player.prepend($sacrifice);
                
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
                            console.log(player.status);
                            updateControls();
                            // if (event.data == 0) {
                            //     playNextSong();
                            // }
                        }
                    }
                });

                player.source = song.source;
                player.source_id = song.source_id;
                player.source_url = song.source_url;

                player.status = 0;
                updateControls();
                
            } else if (song.source == 'soundcloud') {

                var params = {
                    show_comments: false,
                    auto_play: true
                }

                SC.oEmbed(song.source_url, params, function(oembed){

                    $player.prepend(oembed.html);

                    player = SC.Widget($player.children()[0]);

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
                        console.log(player.status);
                        updateControls();
                    });

                    player.bind(SC.Widget.Events.PAUSE, function(eventData) {
                        player.status = 2;
                        console.log(player.status);
                        updateControls();
                    });

                });

            }

            positionPlayer();
            $player.addClass('player--playing');

        },

        init: function (controls) {
            $controls = $(controls);
        
            $(window).resize(function () {
                if ($player && $player.hasClass('player--playing')) {
                    positionPlayer();
                }
            });
        }
    }

}();
