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
    var menuOpen = false;

    function closeMenu() {
        var headerHeight = $('#navigation').height();
        $('#mobile-menu .menu').css('bottom', headerHeight + 'px');
        menuOpen = false;
    }

    function openMenu() {
        var menuHeight = $('#mobile-menu .menu').height();
        $('#mobile-menu .menu').css('bottom', -menuHeight + 'px');
        menuOpen = true;
    }

    $('#menu-button').click(function(e) {
        e.stopPropagation();
        if (menuOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    $('.menu').bind('touchstart', function(e) {
        e.stopPropagation();
    });

    $('#navbar').bind('touchstart', function(e) {
        e.stopPropagation();
    });

    $(window).bind('touchstart', function() {
        if (menuOpen) closeMenu();
    });

    // $(window).scroll(function() {
    //     if (menuOpen) closeMenu();
    // });

    $(window).resize(function() {
        if (menuOpen) closeMenu();
    });

    closeMenu();
});
