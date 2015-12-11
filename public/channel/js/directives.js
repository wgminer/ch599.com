'use strict';

app.filter('unsafe', function($sce) { 
    return $sce.trustAsHtml; 
});

app.directive('bar', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            scope.showFilters = false;
            scope.showSearch = false;

            scope.toggleFilters = function () {
                scope.showFilters = !scope.showFilters;
                scope.showSearch = false;
            }

            scope.toggleSearch = function () {
                scope.showSearch = !scope.showSearch;
                scope.showFilters = false;
            }

        }
    };
});

app.directive('song', function ($interval, $rootScope, Player) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            // var randomAlign = function () {
            //     var floats = ['song--right', 'song--left', 'song--middle'];
            //     var r = Math.floor(Math.random() * floats.length);
            //     return floats[r];
            // }

            var $song = $(element);
            // scope.song.playing = false;

            $song.addClass('song--' + scope.song.source);

            // if (scope.song.highlighted == '1') {
            //     $song.addClass('song--highlighted');
            // }

            // var makePlaying = function () {
            //     scope.song.playing = true;
            //     $song.addClass('song--playing');
            //     $rootScope.$broadcast('positionPlayer');
            // }

            // scope.$on('createPlayer', function (event, song) {

            //     if (scope.song != song) {
            //         scope.song.playing = false;
            //         $song.removeClass('song--playing');   
            //     } else {
            //         makePlaying();
            //     }

            // });

            // var player = Player.get();
            // if (typeof player != 'undefined' && player.source_id == scope.song.source_id) {
            //     makePlaying();
            // }

            // scope.play = function () {
            //     scope.song.playing = true;
            //     $song.addClass('song--playing');

            //     scope.song.index = scope.$index;
            //     $rootScope.$broadcast('createPlayer', scope.song);
            // }

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

            scope.$on('$routeChangeSuccess', function(event, current) {
                positionPlayer();
                setTimeout(function () {
                    positionPlayer();
                }, 1000);
            });

            var positionPlayer = function () {

                var $playing = $('.song.song--playing');

                if ($playing.length > 0) {
                    var $media = $playing.find('.song__media');

                    var top = $media.offset().top;
                    var left = $media.offset().left;
                    var width =  $media.width();
                    var height =  $media.height();

                    $player
                        .addClass('player--playing') 
                        .css({
                            top: top,
                            left: left,
                            width: width,
                            height: height
                        });

                } else {
                    $player.removeClass('player--playing');
                }
            }

            $(window).resize(function () {
                positionPlayer();
            });

            scope.$on('positionPlayer', function () {
                setTimeout(function () {
                    positionPlayer();
                }, 300);
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
            }

            scope.$on('createPlayer', function (event, song) {
                createPlayer(song);
            });

        }
    };
});

app.directive('scrolljack', function ($interval, $rootScope, Api) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var jack = function (e) {


                e = window.event || e;
                var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

                console.log(delta, element[0].scrollWidth - element[0].clientWidth, element[0].scrollLeft)

                if ((delta == 1 && element[0].scrollLeft != 0) || (delta == -1 && (element[0].scrollWidth - element[0].clientWidth != element[0].scrollLeft))) {
                    element[0].scrollLeft -= (delta * 60); 
                    e.preventDefault();
                } else {
                    $(element).off('mousewheel', jack);
                }
                    
                
            }

            imagesLoaded( element[0], function( instance ) {
                

                if (element[0].clientWidth < element[0].scrollWidth) {
                    $(element).hover(function () {
                        console.log('on');
                        $(element).on('mousewheel', jack);
                    }, function () {
                        console.log('off');
                        $(element).off('mousewheel', jack);
                    });
                }
            });

        }
    }
});
    

app.directive('playlist', function ($interval, $rootScope, Api) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            var $playlist = $(element);
            var offsetTop = $playlist.offset().top;
            var limit = 50;

            var fetchSongs = function () {
                var url = scope.baseUrl  + '&limit=' + limit + '&offset=' + scope.offset + scope.params;
                scope.loading = true;
                Api.get(url)
                    .then(function (callback) {
                        scope.loading = false;
                        $rootScope.$broadcast('playlistLoaded');

                        if (callback.length > 0) {
                            scope.playlist = scope.playlist.concat(callback);
                        } else {
                            $(window).off('scroll', infiniteScroll);
                        }
                    }, function (error) {
                        console.log(error);
                    });
            }

            scope.params = '';
            scope.playlist = [];
            scope.offset = 0;
            scope.loading = false;

            scope.paginate = function () {
                scope.offset += limit;
                fetchSongs();
            }

            scope.refresh = function () {
                scope.offset = 0;
                fetchSongs();
            }

            var init = function () {
                fetchSongs();
            }

            init();
            
            scope.$on('nextSong', function (event, index) {
                var playing = _.findWhere(scope.playlist, {playing: true});
                var index = playing.index + 1;
                scope.playlist[index].index = index;
                $rootScope.$broadcast('createPlayer', scope.playlist[index]);
            });

            scope.$on('prevSong', function (event, index) {
                var playing = _.findWhere(scope.playlist, {playing: true});
                $rootScope.$broadcast('createPlayer', scope.playlist[playing.index - 1]);
            });

            var infiniteScroll = function () {
                if (scope.loading == false) {
                    var bottom = $playlist.height() + offsetTop - ($(window).height() * 2);
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > bottom) {
                        scope.paginate();
                    }
                }
            }

            // $(window).on('scroll', infiniteScroll);

        }
    };
});

