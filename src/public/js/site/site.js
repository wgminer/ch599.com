'use strict';

$(function () {

    player.init($('.controls'));

    $('.song .media').click(function () {
        player.create($(this).parents('.song'));
    });

    $('#play').click(function () {
        player.play();
    });

    $('#pause').click(function () {
        player.pause();
    });

    $('#next').click(function () {
        player.next();
    });

    $('#previous').click(function () {
        player.previous();
    });

    $('.annotation').click(function () {
        player.seek($(this));
    });

})