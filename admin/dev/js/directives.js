'use strict';

app.directive('masthead', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {

            $(window).scroll(function () {
                var st = $(window).scrollTop();

                if (st >= 70) {
                    $(element).addClass('masthead__fixed');
                } else {
                    $(element).removeClass('masthead__fixed');
                }
            });

        }
    };
});

app.directive('deleteSong', function ($interval, $rootScope, Api) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);
            var $init = $element.find('.delete__initiate');

            $init.click(function() {

                if (!$element.hasClass('delete--confirm')) {
                    $element.addClass('delete--confirm');
                };

            });

            scope.delete = function (list, song, index) {
                console.log('delete: ' + list + ' and ' + index);

                Api.post('/songs/delete/' + song.id)
                    .then(function (callback) {                
                        list.splice(index, 1);
                    });
            }

            scope.cancel = function () {
                $element.removeClass('delete--confirm');
            }

        }
    };
});

