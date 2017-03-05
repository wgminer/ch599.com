'use strict';

var Search = (function () {

    var module = {};
    var $trigger;
    var $panel;

    module.toggle = function () {

        if ($panel.hasClass('is--open')) {
            $('body').removeClass('is--not-scrollable');
            $panel
                .removeClass('is--open')
        } else {
            $('body').addClass('is--not-scrollable');
            $panel
                .addClass('is--open')
                .find('input').focus();
        }
    }

    module.init = function (panel) {
        $panel = panel;

        $panel.click(function () {
            module.toggle();
        });

        $panel.find('.search__links, .search__form').click(function(event) {
            event.stopPropagation();
        });
    }
        
    return module;

})();