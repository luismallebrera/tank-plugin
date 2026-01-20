(function($) {
    var imggridIso = function ($scope, $) {

   // ============================================================================
   // Isotope
   // More info: http://isotope.metafizzy.co
   // Note: "imagesloaded" blugin is required! https://imagesloaded.desandro.com/
   // ============================================================================

	// init Isotope
	var $container = $("body:not(.elementor-editor-active) .isotope-items-wrap");
	$container.imagesLoaded(function() {
		$container.isotope({
			itemSelector: ".isotope-item",
			layoutMode: "packery",
			transitionDuration: "0.7s",
			percentPosition: true
		});

		setTimeout(function() {
			$container.isotope('layout'); // Refresh Isotope
			ScrollTrigger.refresh(true); // Refresh ScrollTrigger
		}, 500);
	});

	// Filter
	$(".ttgr-cat-list > li > a").on("click", function() {
		var selector = $(this).attr("data-filter");
		$container.isotope({
			filter: selector
		});

		// Refresh ScrollTrigger
		setTimeout(function() {
			ScrollTrigger.refresh(true);
		}, 500);

		return false;
	});

	// Filter item active
	var filterItemActive = $(".ttgr-cat-list > li > a");
	filterItemActive.on("click", function(){
		var $this = $(this);
		if ( !$this.hasClass("active")) {
			filterItemActive.removeClass("active");
			$this.addClass("active");
		}
	});

	// Play video on hover
	$(".tt-gallery-video-wrap-stop").on("mouseenter", function() {
		$(this).find("video").each(function() {
			$(this).get(0).play();
		}); 
	}).on("mouseleave", function() {
		$(this).find("video").each(function() {
			$(this).get(0).load();
		});
	});
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-image-gallery.default', imggridIso);
    });

   
})(jQuery);