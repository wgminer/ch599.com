'use strict';

$(function () {

    var $view = $('.view');

    Api.get('/songs?status_id=1&offset=0&limit=50&formatted=true')
        .then(function(songs) {
            Playlist.create($view, songs);
        });

    Player.init($('.controls'));

    $view.on('click', '.song__overlay', function () {
        Player.create($(this).parents('.song'));
    });

    $('#play').on('click', function () {
        Player.play();
    });

    $('#pause').on('click', function () {
        Player.pause();
    });

    $('#next').on('click', function () {
        Player.next();
    });

    $('#previous').on('click', function () {
        Player.previous();
    });

    $('#nav').on('click', function () {
        if ($('.nav').hasClass('nav--open')) {
            $('.nav').removeClass('nav--open');
            $('.bar').removeClass('bar--open');
        } else {
            $('.nav').addClass('nav--open');
            $('.bar').addClass('bar--open');
        }
    })
});

    