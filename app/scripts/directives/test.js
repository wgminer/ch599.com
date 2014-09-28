'use strict';

angular.module('599App')
  	.directive('test', function () {
    	return {
	      	restrict: 'EA',
	      	link: function ($scope, element, attrs) {
	        	
	      		$scope.testCall = function() {
	      			alert('hi!');
	      		}

	      	}
    	}
  });
