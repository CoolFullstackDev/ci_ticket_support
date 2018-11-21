(function ($) {
    'use strict';

    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa fa-angle-up"></i>'
        });
    }
    if ($.fn.onePageNav) {
        $('#nav').onePageNav({
            currentClass: 'active',
            scrollSpeed: 2000,
            easing: 'easeOutQuad'
        });
    }

    if ($.fn.meanmenu) {
        $('#nav-menu').meanmenu({
            onePage: true
        });
    }
    if ($.fn.jarallax) {
        $('.jarallax').jarallax({
            speed: 0.2
        });
    }


    var $window = $(window);


    $window.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

})(jQuery);

jQuery(window).ready(function () {
    popup_switch = function ($type) {
        jQuery('.login_loading').hide();
        jQuery('.login_errors').hide();
        jQuery('.popup_register').hide();
        jQuery('.popup_login').hide();
        jQuery('.popup_forgot').hide();

        jQuery('.popup_' + $type).show();

        jQuery('#loginModel').modal('show');
    };
    jQuery('.popup_login').submit(function (e) {
        jQuery('.login_errors').hide();
        jQuery('.login_loading').show();
        e.preventDefault();
        jQuery.post(site_url + 'account/login', jQuery(this).serialize(), function (res) {
            res = JSON.stringify(res);
            jQuery('.login_loading').hide();
            if (res.error) {
                jQuery('.login_errors').html(res.message);
                jQuery('.login_errors').show();
            } else {
                window.location = window.location;
            }
            return false;
        });
        return false;
    });

    jQuery('.popup_register').submit(function (e) {

        jQuery('.login_errors').hide();
        jQuery('.login_loading').show();
        e.preventDefault();
        jQuery.post(site_url + 'account/register', jQuery(this).serialize(), function (res) {

            jQuery('.login_loading').hide();
            res = JSON.stringify(res);
            if (res.error) {
                jQuery('.login_errors').html(res.message);
                jQuery('.login_errors').show();
            } else {
                window.location = window.location;
            }
        });
        return false;
    });

    jQuery('.popup_forgot').submit(function (e) {
        e.preventDefault();
        jQuery('.login_errors').hide();
        jQuery('.login_loading').show();
        jQuery.post(site_url + 'account/forgot', jQuery(this).serialize(), function (res) {
            jQuery('.login_loading').hide();
            res = JSON.stringify(res);
            if (res.error) {
                jQuery('.login_errors').html(res.message);
                jQuery('.login_errors').show();
            } else {
                window.location = window.location;
            }
        });
        return false;
    });

    $('.alert-login').on('click', function () {
        alert("Hello! Please login to submit a requrest !!");
    });
    $("#print-topic").click(function () {
        $("#topic-details").printMe();
    });
    $(".btn-filter").click(function () {
        var value = $(this).attr('data-filter');

        if (value === "all")
        {
            $('.table tr').css('display', 'none').fadeIn('slow');
        }
        else
        {
            $('.table tr').css('display', 'none');
            $('.filter').filter('.' + value).fadeIn('slow');

        }
    });

});