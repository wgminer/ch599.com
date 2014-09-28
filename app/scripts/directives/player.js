'use strict';

angular.module('599App')
  	.directive('player', function (PlayerService, $timeout) {
	    return {
	      	restrict: 'EA',
	      	scope: { data: '=' },
		    link: function (scope, element, attrs) {

		    	// -1 	(unstarted)
				// 	0 	(ended)
				// 	1 	(playing)
				// 	2 	(paused)
				// 	3 	(buffering)
				// 	5 	(video cued)

		    	scope.createPlayer = function(song, elem, index) {

		    		song.index = index;

		    		$('.media iframe').remove();
		    		
		    		PlayerService.setPlayerElement(elem);
		    		PlayerService.setPlayerData(song);
		    		scope.$apply();

		    		if (song.source == 'youtube') {

		    			var $sacrifice = $('<div id="player"></div>');
		    			elem.prepend($sacrifice);
		    		
			    		var newPlayer = new YT.Player('player', {
					        videoId: song.id,
					        playerVars: {
					            wmode: "opaque",
					            showinfo: 0,
					            modestbranding: 1
					        },
					        events: {
					        	'onReady': onPlayerReady,
					            'onStateChange': playerEvents
					        }
					    });

					    PlayerService.setPlayer(newPlayer);

					} else if (song.source == 'soundcloud') {

		    			SC.oEmbed(song.url, {auto_play: true}, function(oembed){

		    				PlayerService.setPlayerStatus(1);
				            scope.$apply();

						    elem.prepend(oembed.html);

						    var newPlayer = SC.Widget(elem.children()[0]);

						    PlayerService.setPlayer(newPlayer);
					
				          	newPlayer.bind(SC.Widget.Events.FINISH, function(eventData) {
				            	PlayerService.setPlayerStatus(0);
				            	scope.$apply();
				          	});

				          	newPlayer.bind(SC.Widget.Events.PLAY, function(eventData) {
				            	PlayerService.setPlayerStatus(1);
				            	scope.$apply();
				          	});

				          	newPlayer.bind(SC.Widget.Events.PAUSE, function(eventData) {
				            	PlayerService.setPlayerStatus(2);
				            	scope.$apply();
				          	});

						});

					}			    

		    	}

		    	var onPlayerReady = function (event) {
				    event.target.playVideo();
				}

		    	var playerEvents = function (event) {
					PlayerService.setPlayerStatus(event.data);
					scope.$apply();
				}

				element.bind('click', function(){
					scope.createPlayer(scope.data, element, attrs.index);
				});

		    }
	    };
  	});
