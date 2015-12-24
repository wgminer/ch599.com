'use strict';

app.directive('tabs', function ($location, Api) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            Api.get('/songs?user_id=' + user.id + '&status_id=3')
                .then(function (callback) {
                    scope.errors = callback.length;
                }, function (error) {
                    console.log(error);
                });

            scope.$on('$routeChangeSuccess', function () {
                var path = $location.path();
                scope.status = 1;
                if (path == '/drafts') {
                    scope.status = 2;
                } else if (path == '/errors') {
                    scope.status = 3;
                }
            });

        }
    };
});

app.directive('dropdown', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);

            scope.toggle = function () {
                $element.toggleClass('is--open');
            }

        }
    };
})

$('.dropdown__title').click(function () {
        
    })

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

