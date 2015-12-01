var $ = jQuery;

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll > 0) {
        $("nav").addClass("scrolling");
        $("nav li a").addClass("scrolling");
        $("#navigation").addClass("scrolling");
        $("h1").addClass("scrolling");
    } else {
        $("nav").removeClass("scrolling");
        $("nav li a").removeClass("scrolling");
        $("#navigation").removeClass("scrolling");
        $("h1").removeClass("scrolling");
    }
});

$(window).ready(function() {
    var menu_open = false;

    function closeMenu() {
        $('.menu').css('bottom', '');
        menu_open = false;
    }

    function openMenu() {
        $('.menu').css('bottom', -40 - ($('.menu').height()) + 'px');
        menu_open = true;
    }

    $('#menu-button').click(function(e) {
        e.stopPropagation();
        if (menu_open) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    $('.menu').click(function(e) {
        e.stopPropagation();
    });

    $('#navbar').click(function(e) {
        e.stopPropagation();
    });

    $(window).click(function() {
        if (menu_open) closeMenu();
    });

    $(window).scroll(function() {
        if (menu_open) closeMenu();
    });

    $(window).resize(function() {
        if (menu_open) closeMenu();
    });
});
