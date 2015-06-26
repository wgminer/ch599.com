'use strict';

app.directive('song', function ($interval, $location, $rootScope) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);

            $element.find('.song__media').on('click', function (e) {

                var offset = $element.offset();

                // var x = e.pageX;
                // var y = e.pageY;

                // var clickY = y - offset.top;
                // var clickX = x - offset.left;

                // var setX = parseInt(clickX);
                // var setY = parseInt(clickY);

                $('html, body').animate({scrollTop: offset.top + 'px'}, 500);
                // $('html, body').scrollTop(offset.top);

                $('.bar').addClass('bar--dark');
                $element.addClass('song--playing');
                $element.parent('.view').addClass('view--darken');

                // $element.find('svg').remove();
                // $element.append('<svg class="song__svg"><circle class="song__circle" cx="' + setX + '" cy="' + setY + '" r="' + 0 + '"></circle></svg>');
                 
                // var $circle = $element.find('circle');
                // $circle.animate(
                //     {
                //         'r' : $element.outerWidth()
                //     },
                //     {
                //         duration: 500,
                //         step : function(val){
                //             $circle.attr('r', val);
                //         }
                //     }
                // );

                $rootScope.playing = scope.song;

                setTimeout(function(){
                    window.location.hash = '/' + scope.song.slug;

                    setTimeout(function(){
                        $element.parent('.view').removeClass('view--darken');
                    }, 500);

                }, 500);

            });

        }
    };
});

app.directive('dynamicIframe', function ($interval, $location, $rootScope, Api) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);

        }
    };
});

app.directive('masthead', function ($interval, $location, $rootScope, Api) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {


        }
    };
});

app.filter('html', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
});
