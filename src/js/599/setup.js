'use strict';

$(function () {

    Player.init($('.control-group--player'));

    $('body').on('click', '.song__media', function() {
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
            // event.preventDefault();
        }

        if (key === 39) {
            Player.next();
            // event.preventDefault();
        }

        if (key === 37) {
            Player.prev();
            // event.preventDefault();
        }
    });

    Playlist.init($('.feed'));

    $('.paginate').click(function () {
        Playlist.paginate($(this));
    });

    Search.init($('.search'));

    $('.control--search').click(function () {
        Search.toggle();
    });

    // Typed.js stuff
    $('.hero .js--typed').typed({
        strings: ["You're on Channel 599,<br> a music blog started in Rob's room."],
        contentType: 'html',
        showCursor: false
    });

    $('body').on('click', '.song__media', function() {
        Player.create($(this).parents('.song'));
    });

    $('.feed img.lazy').lazyload().removeClass('lazy');

})