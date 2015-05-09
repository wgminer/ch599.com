'use strict';

var player = function () {

    var $playing = false;
    var $controls = false;
    var player = false;

    var updateControls = function () {
        $controls.removeClass('playing paused loading');
        $controls.addClass('show');
        if (player.status == 1) {
            $controls.addClass('playing');
        } else if (player.status == 2) {
            $controls.addClass('paused');
        } else {
            $controls.addClass('loading');
        }
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

            console.log($playing);

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

            if (player && player.source_id == source_id) {

                if (player.source == 'youtube') {
                    timestamp = timestamp / 1000;
                }

                player.seekTo(timestamp);
                this.play();

            } else {

                var $song = $annotation.parents('.song');

                this.create($song, timestamp);
            }
        },
        create: function ($song, seekTo) {

            var $aspect = $song.find('.aspect-ratio');
            var song = {
                source: $song.data('source'),
                source_id: $song.data('source-id'),
                source_url: $song.data('source-url')
            }

            if (typeof seekTo == 'undefined') {
                seekTo = 0;
            }

            if ($playing) {
                $playing.removeClass('playing')
                    .find('iframe').remove();
            }

            $song.addClass('playing');
            $playing = $song;
            
            if (song.source == 'youtube') {

                var $sacrifice = $('<div id="player"></div>');
                $aspect.prepend($sacrifice);
                
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

                console.log(player);
                
            } else if (song.source == 'soundcloud') {

                var params = {
                    show_comments: false,
                    auto_play: true
                }

                SC.oEmbed(song.source_url, params, function(oembed){

                    $aspect.prepend(oembed.html);

                    player = SC.Widget($aspect.children()[0]);

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
        },
        init: function (controls) {
            $controls = controls;
        }
    }

}();
