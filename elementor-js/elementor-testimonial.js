(function($) {
    var testiMonial = function ($scope, $) {

    // =======================================================================================
	// Testimonials slider
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-testimonials-slider").length) {
		$(".tt-testimonials-slider").each(function() {
			var $ttTestimonialsSlider = $(this);

			// Data attributes
			// ================
			var $dataSimulateTouch = $ttTestimonialsSlider.data("simulate-touch");
			var $autoplay = $ttTestimonialsSlider.data("autoplay") ? { delay: $ttTestimonialsSlider.data("autoplay"), } : $ttTestimonialsSlider.data("autoplay");
			var $dataLoop = $ttTestimonialsSlider.data("loop") ? { loopedSlides: 100, } : $ttTestimonialsSlider.data("loop");

			if ($ttTestimonialsSlider.is("[data-speed]")) {
				var $dataSpeed = $ttTestimonialsSlider.data("speed");
			} else {
				var $dataSpeed = 900; // by default
			}

			// Init Swiper
			// =============
			var $ttTestimonialsSliderSwiper = new Swiper ($ttTestimonialsSlider.find(".swiper")[0], {
				// Parameters
				direction: "horizontal",
				slidesPerView: "auto",
				spaceBetween: 0,
				mousewheel: false,
				longSwipesRatio: 0.3,
				grabCursor: true,
				autoHeight: true,
				centeredSlides: true,
				preventInteractionOnTransition: false, // No actions during transition
				speed: $dataSpeed,
				simulateTouch: $dataSimulateTouch,
				autoplay: $autoplay,
				loop: $dataLoop,

				// Navigation (arrows)
				navigation: {
					nextEl: $ttTestimonialsSlider.find(".tt-ts-nav-next")[0],
					prevEl: $ttTestimonialsSlider.find(".tt-ts-nav-prev")[0],
					disabledClass: "tt-ts-nav-arrow-disabled",
				},

				// Pagination
				pagination: {
					el: ".tt-ts-pagination",
					type: "bullets",
					modifierClass: "tt-ts-pagination-",
					dynamicBullets: true,
					dynamicMainBullets: 1,
					clickable: true,
				}
			});

			// Auto height fix
			setTimeout(function() {
				$ttTestimonialsSliderSwiper.updateAutoHeight();
			}, 100);

			// Scale down animation on slider click
			if ($ttTestimonialsSlider.hasClass("ts-scale-down")) {
				$ttTestimonialsSlider.find(".swiper-wrapper").on("mousedown touchstart pointerdown", function(e) {
					if (e.which === 1) { // Affects the left mouse button only!
						gsap.to($ttTestimonialsSlider.find(".swiper-slide"), { duration: 0.7, scale: 0.9 });
					}
				});
				$("body").on("mouseup touchend pointerup", function() {	
					gsap.to($ttTestimonialsSlider.find(".swiper-slide"), { duration: 0.7, scale: 1, clearProps: "scale" });
				});
			}
		});
	}


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-testimonial.default', testiMonial);
    });

   
})(jQuery);