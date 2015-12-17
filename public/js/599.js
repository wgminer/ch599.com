'use strict';

$(function () {

    var bg = '#ff0000';

    $('.dropdown__title').click(function () {

        $(this).parents('.dropdown').toggleClass('is--open');

    });

    // var setColor = function (hex) {
    //     $('.hero').css('background-color', hex);
    // }

    // setColor(bg);

    // $(window).scroll(function () {

    //     var st = $('body').scrollTop();
    //     // console.log(st);

    //     $('.post').each(function () {

    //         var top = $(this).position().top;
    //         var height = $(this).outerHeight();
    //         var hex = $(this).attr('data-color');

    //         if (st >= top - (height/2) && st <= top + (height/2) && bg != hex) {
    //             bg = hex;
    //             setColor(bg);
    //         }

    //     });

    // });

})