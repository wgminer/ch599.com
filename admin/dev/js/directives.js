'use strict';

'use strict';

app.directive('song', function ($interval, $rootScope) {
    return {
        restrict: 'C',
        scope: {
            data: '='
        },
        link: function (scope, element, attrs) {

            var $song = $(element);
            var windowMiddle = $(window).height() / 2;

            var months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ];

            var setDate = _.throttle(function(){
                var top = $song.offset().top;
                var scrollMiddle = $(window).scrollTop() + windowMiddle;

                if (scrollMiddle - 20 < top && top < scrollMiddle + 20) {
                    var i = new Date(scope.data.created_at).getMonth();
                    var year = new Date(scope.data.created_at).getFullYear();
                    $rootScope.date = months[i] + ' ' + year;
                    scope.$apply();
                }

            }, 300);

            $(window).scroll(setDate);




        }
    };
});

