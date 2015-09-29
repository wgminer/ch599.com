'use strict';

app.directive('body', function ($timeout, $location, $interval) {
    return {
        restrict: 'AEC',
        link: function link(scope, element, attrs) {}
    };
});

app.directive('connect', function ($cookies, $location, Local) {
    return {
        restrict: 'A',
        link: function link(scope, element, attrs) {

            $(element).click(function () {
                SC.connect(function () {
                    SC.get('/me', function (me) {
                        Local.user = me;
                        $cookies.put('token', SC.accessToken());
                        $location.path('/' + Local.user.permalink);
                        scope.$apply();
                    });
                });
            });
        }
    };
});

app.directive('song', function ($cookies, $interval, Local, Player) {
    return {
        restrict: 'E',
        link: function link(scope, element, attrs) {

            var playerBroadcast;
            var startWatching = function () {
                console.log('START WATCHING: ' + scope.song.title);
                playerBroadcast = scope.$on('playerStatusChange', function(event, data) {
                    if (data.song_id == scope.song.id) {
                        console.log(data);
                    } else { // KILL IT!
                        console.log('KILLING: ' + scope.song.title);
                        stopWatching();
                    }
                });
            }

            var stopWatching  = function () {
                scope.$$listeners = [];
                // playerBroadcast();
            }

            $(element).dblclick(function () {
                Player.init(scope.song.id, true);
                startWatching();
            });

            $(element).find('.song__play').click(function () {
                Player.toggle(scope.song.id);
                startWatching();
            });



        }
    };
});