'use strict';

angular.module('channel599')

    .directive('song', function ($rootScope, Player, $q, $log) {
        return {
            restrict: 'E',
            scope: false,
            link: function (scope, element, attrs) {

                var $song = $(element);

                function onPlayerReady (event) {
                    event.target.playVideo();
                }

                function playerEvents (event) {
                    Player.change('status', event.data);

                    if (event.data === 0) {
                        autoAdvance();
                    }
                }

                function createPlayer(songData, song) {

                    var newPlayer = {};
                    var promise;
                    var $media = song.find('.media');

                    $('.media iframe').remove();
                    $('.song').removeClass('playing');
                    song.addClass('playing');


                    songData.active = true;

                    var deferred = $q.defer();

                    if (songData.source == 'youtube') {

                        var $sacrifice = $('<div id="player"></div>');
                        $media.prepend($sacrifice);

                        newPlayer = new YT.Player('player', {
                            videoId: songData.sourceId,
                            playerVars: {
                                wmode: 'opaque',
                                showinfo: 0,
                                modestbranding: 1
                            },
                            events: {
                                'onReady': onPlayerReady,
                                'onStateChange': playerEvents
                            }
                        });

                        newPlayer.source = 'youtube';
                        deferred.resolve(newPlayer);
                    }

                    if (songData.source == 'soundcloud') {

                        SC.oEmbed(songData.url, {auto_play: true}, function(oembed){

                            $media.prepend(oembed.html);

                            newPlayer = SC.Widget($media.children()[0]);

                            newPlayer.source = 'soundcloud';
                            newPlayer.status = 1;

                            newPlayer.bind(SC.Widget.Events.FINISH, function() {
                                Player.change('status', 0);
                                autoAdvance();
                            });

                            newPlayer.bind(SC.Widget.Events.PLAY, function() {
                                Player.change('status', 1);
                            });

                            newPlayer.bind(SC.Widget.Events.PAUSE, function() {
                                Player.change('status', 2);
                            });

                            deferred.resolve(newPlayer);                            

                        });

                    }         

                    return deferred.promise;      

                }

                function autoPlay (data, element) {
                    createPlayer(data, element).then(function(newPlayer){
                        Player.set(newPlayer);
                    }, function(error){
                        throw error;
                    })
                }

                function autoAdvance () {
                    autoPlay(scope.$parent.playlist.songs[scope.$index + 1], $song.next('.song'));
                }
                
            }
        };
    })

    .directive('controls', function ($rootScope, Player) {
        return {
            restrict: 'C',
            link: function (scope, element, attrs) {

                var $button = $(element).find('button');

                scope.$on('player:changed', function(event, player) {
                    console.log(player);
                    if (player.status === 2) {
                        $button.removeClass().addClass('ion-play');
                    } else if (player.status === 1) {
                        $button.removeClass().addClass('ion-pause');
                    }
                });

                $button.click(function(){
                    var player = Player.get();
                    console.log(player);
                    if (player) {
                        if (player.status === 2) {
                            if (player.source === 'youtube'){
                                player.playVideo();
                            } else if(player.source === 'soundcloud'){ 
                                player.play();
                            }
                        } else if (player.status === 1) {
                            if (player.source === 'youtube'){
                                player.pauseVideo();
                            } else if(player.source === 'soundcloud'){ 
                                player.pause();
                            }
                        }
                    }
                });
                
            }
        }
    });

