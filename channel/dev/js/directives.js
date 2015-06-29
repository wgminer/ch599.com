'use strict';

app.directive('bar', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {


        }
    };
});

var i = 1;
app.directive('song', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            
            var $song = $(element);
            scope.song.playing = false;

            scope.$on('createPlayer', function (event, song) {

                if (scope.song != song) {
                    scope.song.playing = false;
                    $song.removeClass('song--playing');   
                } else {
                    scope.song.playing = true;
                    $song.addClass('song--playing');
                    console.log('happening twice? ' + i);
                    $rootScope.$broadcast('positionPlayer');
                }

            });

            scope.play = function () {
                scope.song.playing = true;
                $song.addClass('song--playing');

                scope.song.index = scope.$index;
                $rootScope.$broadcast('createPlayer', scope.song);
            }

        }
    };
});

app.directive('controls', function ($interval, $rootScope, Player, Playlist) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            scope.player;
            scope.showControls = false;

            scope.$on('playerStatusChange', function (event) {
                scope.showControls = true;
                scope.player = Player.get();
                scope.$apply();
            });

            scope.play = function () {
                if (scope.player.source == 'youtube') {
                    scope.player.playVideo();
                } else {
                    scope.player.play();
                }
            }

            scope.pause = function () {
                if (scope.player.source == 'youtube') {
                    scope.player.pauseVideo();
                } else {
                    scope.player.pause();
                }
            }

            scope.next = function () {
                $rootScope.$broadcast('nextSong');
            }

            scope.previous = function () {
                $rootScope.$broadcast('prevSong');
            }
            
        }
    };
});

app.directive('player', function ($interval, $rootScope, Player) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            var $player = $(element);
            var player;

            var positionPlayer = function () {

                var $playing = $('.song.song--playing');

                if ($playing.length > 0) {
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
            }

            // $(window).resize(function () {
            //     if ($player && $player.hasClass('player--playing')) {
            //         positionPlayer();
            //     }
            // });

            scope.$on('positionPlayer', function () {
                positionPlayer();
            });
            
            var createPlayer = function (song) {

                $player.find('iframe').remove();

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
                            },
                            onStateChange: function (event) {
                                Player.status(event.data);
                                if (event.data == 0) {
                                    $rootScope.$broadcast('nextSong');
                                }
                            }
                        }
                    });

                    player.source = song.source;
                    player.source_id = song.source_id;
                    player.source_url = song.source_url;
                    player.status = 0;

                    Player.set(player);
                    
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

                        player.bind(SC.Widget.Events.PLAY, function(eventData) {
                            Player.status(1);
                        });

                        player.bind(SC.Widget.Events.PAUSE, function(eventData) {
                            Player.status(2)
                        });

                        Player.set(player);

                    });
                }

                $player.addClass('player--playing');
            }

            scope.$on('createPlayer', function (event, song) {
                createPlayer(song);
            });

        }
    };
});

app.directive('playlist', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            scope.$on('nextSong', function (event, index) {
                var playing = _.findWhere(scope.songs, {playing: true});
                var index = playing.index + 1;
                scope.songs[index].index = index;
                $rootScope.$broadcast('createPlayer', scope.songs[index]);
            });

            scope.$on('prevSong', function (event, index) {
                var playing = _.findWhere(scope.songs, {playing: true});
                $rootScope.$broadcast('createPlayer', scope.songs[playing.index - 1]);
            });

        }
    };
});

