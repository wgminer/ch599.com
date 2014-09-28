'use strict';

angular.module('599App')
  	.factory('SongService', function () {

		var latest = function(){

			var songs = [
				{
					"id": "rEMsjeq43_U",
					"title": "ScHoolboy Q - Man Of The Year",
					"url": "http://www.youtube.com/watch?v=rEMsjeq43_U",
					"image": "http://img.youtube.com/vi/rEMsjeq43_U/hqdefault.jpg",
					"source": "youtube"
				},
				{
					"id": "",
					"title": "WhiteNoize - This Means War",
					"url": "https://soundcloud.com/whitenoize/this-means-war-original-mix",
					"image": "https://i3.sndcdn.com/artworks-000072578013-jebb1n-t500x500.jpg?435a760",
					"source": "soundcloud"
				},
				{
					"id": "GPJRJjAgfEs",
					"title": "Wild Beasts - Loop the Loop (D-Pulse edit)",
					"url": "https://www.youtube.com/watch?v=GPJRJjAgfEs",
					"image": "http://img.youtube.com/vi/GPJRJjAgfEs/hqdefault.jpg",
					"source": "youtube"
				},
				{
					"id": "",
					"title": "D-Mad - She Gave Happiness (Arty Remix)",
					"url": "https://soundcloud.com/artyofficial/she-gave-happiness-arty-remix",
					"image": "https://i1.sndcdn.com/artworks-000071525210-0bpw0u-t500x500.jpg?435a760",
					"source": "soundcloud"
				},
				{
					"id": "",
					"title": "ilan Bluestone - Spheres",
					"url": "https://soundcloud.com/anjunabeats/ilanbluestone-spheres",
					"image": "https://i3.sndcdn.com/artworks-000065687718-fb1rxi-t500x500.jpg?435a760",
					"source": "soundcloud"
				},
				{
					"id": "wKsmvmX_GxE",
					"title": "Allure - What I Got",
					"url": "https://www.youtube.com/watch?v=wKsmvmX_GxE",
					"image": "http://img.youtube.com/vi/wKsmvmX_GxE/hqdefault.jpg",
					"source": "youtube"
				},
				{
					"id": "",
					"title": "Hermitude x Flume - Hyperparadise (GANZ Flip)",
					"url": "https://soundcloud.com/iamganz/hermitude-x-flume",
					"image": "https://i4.sndcdn.com/artworks-000070790362-35yfc9-t500x500.jpg?435a760",
					"source": "soundcloud"
				}
			];

			return songs;

		};


		// Public API

		return {
			latest: latest,
		};

	});

	