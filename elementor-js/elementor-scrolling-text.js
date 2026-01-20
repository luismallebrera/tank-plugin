(function($) {
    var scrollTxt = function ($scope, $) {

    // ==================================
	// Scrolling text
	// ==================================

	// Hover scrolling speed.
	$(".tt-scrolling-text").each(function() {
		var $tt_stSpeed = $(this).data("scroll-speed");
		$(this).find(".tt-scrolling-text-inner").css({ 
			"animation-duration": $tt_stSpeed + "s",
		});
	});


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-scroll-text.default', scrollTxt);
    });

   
})(jQuery);