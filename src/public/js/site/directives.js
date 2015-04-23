'use strict';

angular.module('channel599')
    .directive('masthead', function ($rootScope, $location, Api) {
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {

            }
        }   
    })
    .directive('controls', function ($rootScope) {
        return {
            restrict: 'C',
            link: function(scope, element, attrs) { 

                scope.prev = function () {

                }

                scope.playPause = function () {
                    if ($rootScope.currentSong.status == 'paused') {                        
                        // $rootScope.currentSong.player.playVideo();
                        $rootScope.currentSong.player.play();
                    } else {
                        // $rootScope.currentSong.player.pauseVideo();
                        $rootScope.currentSong.player.pause();
                    }
                    
                }

                scope.next = function () {
                    $rootScope.$broadcast('playNextSong');
                }

                scope.prev = function () {
                    $rootScope.$broadcast('playPrevSong');
                }

            }
        };
    })
    .directive('playlist', function ($rootScope, $timeout) {
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {

                console.log('hi');

                var $holster = $('#holster');
                var $playing;

                scope.playSong = function ($post, i) {

                    $playing = $('.playing');
                    var $position = $post.find('.position');
                    var song = scope.$parent.songs[i];

                    $playing.removeClass('playing');
                    $('iframe').remove();
                    $post.addClass('playing');
                    $playing = $post;
                    
                    $rootScope.currentSong.index = i;
                    $rootScope.currentSong.id = song.source_id;

                    if (song.source == 'youtube') {

                        var $sacrifice = $('<div id="player"></div>');
                        $post.find('.media').prepend($sacrifice);
                        
                        var newPlayer = new YT.Player('player', {
                            videoId: song.source_id,
                            playerVars: {
                                wmode: 'opaque',
                                showinfo: 0,
                                modestbranding: 1
                            },
                            events: {
                                onReady: function (event) {
                                    event.target.playVideo();

                                    if (lastProgress > 0) {
                                        event.target.seekTo(lastProgress);
                                    }
                                },
                                onStateChange: function (event) {
                                    Local.player.setStatus(event.data);
                                    if (event.data == 0) {
                                        playNextSong();
                                    }
                                    scope.$apply();
                                }
                            }
                        });

                        newPlayer.status = 1;
                        
                    } else if (song.source == 'soundcloud') {

                        // $rootScope.currentSong = true;

                        SC.oEmbed(song.source_url, {auto_play: true}, function(oembed){
                            // console.log(oembed);
                            $holster.prepend(oembed.html);
                            $rootScope.currentSong.player = SC.Widget($holster.children()[0]);

                            if ($post.hasClass('pin-open')) {
                                $rootScope.$broadcast('zooming', $rootScope.currentSong.id);
                            }
                            
                            // Bind all the SC events to the player...
                        
                            $rootScope.currentSong.player.bind(SC.Widget.Events.FINISH, function(eventData) {
                                playNextSong();
                                scope.$apply();
                            });

                            $rootScope.currentSong.player.bind(SC.Widget.Events.PLAY, function(eventData) {
                                $rootScope.currentSong.status = 'playing';
                                scope.$apply();
                            });

                            $rootScope.currentSong.player.bind(SC.Widget.Events.PAUSE, function(eventData) {
                                $rootScope.currentSong.status = 'paused';
                                scope.$apply();
                            });

                            $rootScope.currentSong.player.bind(SC.Widget.Events.PLAY_PROGRESS, function(eventData) {
                                $rootScope.currentSong.position = eventData.currentPosition / song.duration * 100 + '%';
                                $position.css('width', $rootScope.currentSong.position);
                                // console.log(percent);
                            });

                            $rootScope.currentSong.player.bind(SC.Widget.Events.LOAD_PROGRESS, function(eventData) {
                                console.log(eventData);
                            });

                        });

                    }
                }

                var playNextSong = function () {
                    var $nextSong = $playing.next('song');
                    if ($nextSong.length > 0) {
                        scope.playSong($nextSong, $rootScope.currentSong.index + 1);
                    } else {
                        $('.media iframe').remove();
                        $playing.removeClass('playing');
                        $rootScope.$broadcast('playingEnded');
                    }
                }

                scope.$on('playNextSong', function() {
                    console.log($playing.length);
                    if ($playing.length > 0) {
                        playNextSong();
                    }
                });

                scope.$on('playPrevSong', function() {
                    if ($playing.length > 0) {
                        var $prevPost = $playing.prev('song');
                        scope.playSong($prevPost, $rootScope.currentSong.index - 1);
                    }
                });
            }
        };
    })
    .directive('post', function ($rootScope, $timeout, Api) {
        return {
            restrict: 'E',
            link: function(scope, element, attrs) {

                var $element = $(element);

                $element.find('.media').click(function(){
                    console.log(scope);
                    scope.$parent.playSong($element, scope.$index);
                });

            }
        };
    })