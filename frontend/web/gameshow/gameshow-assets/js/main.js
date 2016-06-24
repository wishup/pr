
/** GLOBAL Variables */

var isMobile;
var html;
var windowWidth;
var windowHeight;
var clickEventType = ((document.ontouchstart !== null) ? 'click' : 'touchstart');


(function ($) {
    "use strict";

    html = $('html');

    /** Detect Device Type */
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        isMobile = true;
        html.addClass('mobile');
    } else {
        isMobile = false;
        html.addClass('desktop');
    }


    function setSize(){
        windowWidth = $(window).width();
        windowHeight = $(window).height();
        
        $('.page-wrapper').css('min-height',windowHeight +'px');
    }
    setSize();

    /** Window Load */
    $(window).load(function () {
        html.addClass('page-loaded');
    });

    /** Window Resize */
    $(window).resize(function () {
        setSize();
    });

})(jQuery);

function initMainNavigation(container) {

    // Add dropdown toggle that displays child menu items.
    var dropdownToggle = $('<button />', {
        'class': 'dropdown-toggle'
    });

    container.find('.menu-item-has-children > a').after(dropdownToggle);

    // Toggle buttons and submenu items with active children menu items.
    container.find('.current-menu-ancestor > button').addClass('toggled-on');
    container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');

    container.find('.dropdown-toggle').click(function (e) {
        var _this = $(this);

        e.preventDefault();
        _this.toggleClass('toggled-on');
        _this.next('.children, .sub-menu').toggleClass('toggled-on');
    });
}
