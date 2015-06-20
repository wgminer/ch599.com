'use strict';

app.directive('song', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            var $element = $(element);

            scope.playSong = function () {

                var offset = $element.offset().top - 20;

                $('html, body').animate({scrollTop: offset + 'px'}, 125);

            }

        }
    };
});

