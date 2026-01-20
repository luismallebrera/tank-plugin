(function($) {
    var postscrollTxt = function ($scope, $) {

    // Title on link hover.
		$(".portfolio-interactive-item").each(function() {
			$(this).find(".pi-item-title-link").on("mouseenter", function() {
				$(this).parent().addClass("pi-item-hover");
			}).on("mouseleave", function() {
				$(this).parent().removeClass("pi-item-hover");
			});
		});


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-post-interactive.default', postscrollTxt);
    });

   
})(jQuery);