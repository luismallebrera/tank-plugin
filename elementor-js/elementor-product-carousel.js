(function($) {
    var elproductCarousel = function ($scope, $) {

    // =======================================================================================
	// Portfolio carousel (full screen carousel)
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-el-product-carousel").length) {
		$(".tt-el-product-carousel").each(function() {
			var $ttProductCarousel = $(this);

			// Data attributes
			// ================
			var $dataSimulateTouch = $ttProductCarousel.data("simulate-touch");
			var $dataLoop = $ttProductCarousel.data("loop") ? { loopedSlides: 100, } : $ttProductCarousel.data("loop");
			var $dataAutoplay = $ttProductCarousel.data("autoplay") ? { delay: $ttProductCarousel.data("autoplay"), } : $ttProductCarousel.data("autoplay");

			if ($ttProductCarousel.is("[data-slides-per-view]")) {
				var $dataSlidesPerView = $ttProductCarousel.data("slides-per-view");
			} else {
				var $dataSlidesPerView = 4; // by default
			}

			if ($ttProductCarousel.is("[data-space-between]")) {
				var $dataSpaceBetween = $ttProductCarousel.data("space-between");
			} else {
				var $dataSpaceBetween = 0; // by default
			}

			if ($ttProductCarousel.is("[data-speed]")) {
				var $dataSpeed = $ttProductCarousel.data("speed");
			} else {
				var $dataSpeed = 800; // by default
			}

			// Init Swiper
			// =============
			var $ttProductCarouselSwiper = new Swiper($ttProductCarousel.find(".swiper")[0], {
				slidesPerView: 1,
				slidesPerGroup: 1,
				preloadImages: false, // Needed for lazy loading
				watchSlidesProgress: true, // Needed for lazy loading (if slidesPerView is "auto" or more than 1)
				speed: $dataSpeed,
				resistanceRatio: 0.85,
				longSwipesRatio: 0.2,
				shortSwipes: true,
				lazy: true,
				spaceBetween: $dataSpaceBetween,
				loop: $dataLoop,
				autoplay: $dataAutoplay,
				simulateTouch: $dataSimulateTouch,
				grabCursor: $dataSimulateTouch,

				navigation: {
					nextEl: $ttProductCarousel.find(".tt-prc-arrow-next")[0],
					prevEl: $ttProductCarousel.find(".tt-prc-arrow-prev")[0],
					disabledClass: "tt-prc-arrow-disabled",
				},

				breakpoints: {
					// When window width is 1200px or larger
					1200: {
						slidesPerView: $dataSlidesPerView,
					},
					// When window width is 992px or larger
					992: {
						slidesPerView: 3,
					},
					// When window width is 560px or larger
					560: {
						slidesPerView: 2,
					}
				},
			});

		});

	}
	$(".tt-cart-carousel .button").each(function(i){
		$(this).removeClass('button');
	})


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-product-carousel.default', elproductCarousel);
    });

   
})(jQuery);