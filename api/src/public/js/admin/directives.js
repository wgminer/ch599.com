'use strict';

app.directive('masthead', function ($rootScope, $location, Api) {
    return {
        restrict: 'E',
        link: function(scope, element, attrs) {

        }
    }   
});

app.directive('dynamicIframe', function ($rootScope, $location, Api) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            $(element).attr('src',  'https://www.youtube.com/embed/' + song.source_id)
        }
    }   
});

app.filter('trusted', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);
