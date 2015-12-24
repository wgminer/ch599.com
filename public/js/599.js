'use strict';

$(function () {

    Player.init($('.control-group--player'));

       $('.song__media').click(function () {
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

       $('.control--previous').click(function () {
           Player.previous();
       });

       $('.song__annotation').click(function () {
           Player.seek($(this));
       });

       $('body').removeClass('faded');



})