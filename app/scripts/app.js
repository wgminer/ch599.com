'use strict';

angular.module('599App', [
	'ngCookies',
	'ngResource',
	'ngSanitize',
	'ngRoute'
])
.run(function(){

	SC.initialize({
		client_id: 'e0ac220c7f34ae5602f816d9b51e12e3'
	});
	
})
.config(function ($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl: 'views/playlist.html',
			controller: 'PlaylistCtrl'
		})
		.otherwise({
			redirectTo: '/'
		});
});
