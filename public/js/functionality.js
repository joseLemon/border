$(window).scroll(function() {
    /* DETECT IF NAVBAR IS AT TOP */
    var $nav = $('.navbar');
    if( $(this).scrollTop() == 0 ) {
        $nav.removeClass('scrolling');
    } else if( !$nav.hasClass('scrolling') ) {
        $nav.addClass('scrolling');
    }
});

$(document).ready(function () {
    $('.smoothscroll').click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, {
            duration: 1000,
            easing: 'easeInOutCubic'
        });
    });

    $(".navbar-nav .nav-item").on("click", function(){
        $(".navbar-nav").find(".active").removeClass("active");
        $(this).closest('.nav-item').addClass("active");
    });
});