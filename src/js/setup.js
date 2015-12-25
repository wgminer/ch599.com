'use strict';

$(function () {

    Player.init($('.control-group--player'));

    $('.feed').on('click', '.song__media', function() {
        Player.create($(this).parents('.song'));
    });

    $('.control--play').click(function () {
        Player.play();
    });

    $('.control--pause').click(function () {
        Player.pause();
    });

    $('.control--next').click(function () {
        Player.next();
    });

    $('.control--prev').click(function () {
        Player.prev();
    });

    $('.song__annotation').click(function () {
        Player.seek($(this));
    });

    $(window).keydown(function(event) {
        var key = event.keyCode;

        if (key === 32) {
            Player.toggle();
        }

        if (key === 39) {
            Player.next();
        }

        if (key === 37) {
            Player.prev();
        }

        event.preventDefault();
    });

    Playlist.init($('.feed'));

    $('.paginate').click(function () {
        Playlist.paginate($(this));
    });

})