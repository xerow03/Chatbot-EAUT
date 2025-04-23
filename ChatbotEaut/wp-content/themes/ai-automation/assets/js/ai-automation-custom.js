jQuery(function($) {
    "use strict";

    // Scroll to top functionality
    $(window).on('scroll', function() {
        if ($(this).scrollTop() >= 50) {
            $('#return-to-top').fadeIn(200);
        } else {
            $('#return-to-top').fadeOut(200);
        }
    });

    $('#return-to-top').on('click', function() {
        $('body,html').animate({ scrollTop: 0 }, 500);
    });

    // Side navigation toggle
    $('.gb_toggle').on('click', function() {
        ai_automation_Keyboard_loop($('.side_gb_nav'));
    });

    // Preloader fade out
    setTimeout(function() {
        $(".loader").fadeOut("slow");
    }, 1000);

    // Sticky menu
    $(window).on('scroll', function() {
        var data_sticky = $('.menubar').data('sticky');
        if (data_sticky === true) {
            if ($(this).scrollTop() > 1) {
                $('.menubar').addClass("stick_head");
            } else {
                $('.menubar').removeClass("stick_head");
            }
        }
    });

});

// Mobile responsive menu
function ai_automation_menu_open_nav() {
    jQuery(".sidenav").addClass('open');
}

function ai_automation_menu_close_nav() {
    jQuery(".sidenav").removeClass('open');
}

jQuery(document).ready(function($) {
    var owl = $('#slider .owl-carousel');
    
    owl.owlCarousel({
        margin: 20,
        rtl: $('html').attr('dir') === 'rtl',
        nav: false, 
        autoplay: false,
        loop: true,
        dots: false,
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });

    function ai_automation_updatePagination(index) {
        $('.pagination-item').removeClass('active');
        $('.pagination-item[data-slide="' + index + '"]').addClass('active');
    }

    owl.on('changed.owl.carousel', function(event) {
        var currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
        var totalItems = event.item.count;
        var activeIndex = (currentIndex % totalItems + totalItems) % totalItems;
        ai_automation_updatePagination(activeIndex);
    });

    $('.pagination-item').on('click', function() {
        var slideIndex = $(this).data('slide');
        owl.trigger('to.owl.carousel', [slideIndex, 300]);
    });
});