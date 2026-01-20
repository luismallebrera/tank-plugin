(function($) {
    var elportCarouselshover = function ($scope, $) {

    // =======================================================================================
	// Portfolio hover carousel (full screen carousel)
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".elementor-editor-active .tt-portfolio-hover-carousel").length) {
		$("body").addClass("tt-portfolio-hover-carousel-on");

		$(".elementor-editor-active .tt-portfolio-hover-carousel").each(function() {
			var $ttPortfolioHoverCarousel = $(this);

			// Data attributes
			// ================
			var $dataSimulateTouch = $ttPortfolioHoverCarousel.data("simulate-touch");
			var $dataGrabCursor = $ttPortfolioHoverCarousel.data("grab-cursor");
			var $dataLoop = $ttPortfolioHoverCarousel.data("loop") ? { loopedSlides: 100, } : $ttPortfolioHoverCarousel.data("loop");


			// Init Swiper
			// =============
			var $ttPortfolioHoverCarouselSwiper = new Swiper ($ttPortfolioHoverCarousel.find(".swiper")[0], {
				// Parameters
				direction: "horizontal",
				slidesPerView: "auto",
				spaceBetween: 0,
				shortSwipes: true,
				speed: 900, 
				keyboard: false,
				mousewheel: true,
				watchSlidesProgress: true,
				simulateTouch: $dataSimulateTouch,
				grabCursor: $dataGrabCursor,
				loop: $dataLoop,

				// Events
				on: {

					init: function () {

						// Fix position issue on load.
						setTimeout(function(){
							$ttPortfolioHoverCarouselSwiper.update();
						}, 100);


						// Carousel item hover
						// ====================

						// First image
						var $phcFirstImage = $(".phc-image").first();
						$phcFirstImage.addClass("active");
						$phcFirstImage.find("video").each(function() {
							$(this).get(0).play();
						});

						// First slide
						var $phcFirstSlide = $(".elementor-editor-active .tt-portfolio-hover-carousel").find(".swiper-slide").not(".swiper-slide-duplicate").first();
						$phcFirstSlide.addClass("active");
						
						// If first slide image is light
						if ($phcFirstSlide.hasClass("active")) {
							if ($phcFirstImage.hasClass("phc-image-is-light")) {
								$("body").addClass("tt-light-bg-on");
							} else {
								$("body").removeClass("tt-light-bg-on");
							}
						}

						// Mouse hover
						$ttPortfolioHoverCarousel.find(".swiper-slide").on("mouseenter touchstart", function() {
							if (!$(this).hasClass("active")) {
								$('.phc-image').find('video').each(function() {
									$(this).get(0).pause();
								});
								$(this).addClass("active").siblings().removeClass("active");
								var $phcSlide = $(this).data("slide");
								var $phcImage = $('.phc-image[data-slide="' + $phcSlide + '"]');
								$ttPortfolioHoverCarousel.find(".phc-image").removeClass("active");
								$phcImage.addClass("active");
								$phcImage.find('video').each(function() {
									$(this).get(0).play();
								});

								// If image is light
								if ($(this).parents($ttPortfolioHoverCarousel).find($phcImage).hasClass("phc-image-is-light")) {
									$("body").addClass("tt-light-bg-on");
								} else {
									$("body").removeClass("tt-light-bg-on");
								}

								// Slides count
								var $phcCounter = $('.tt-phc-count span[data-slide="' + $phcSlide + '"]');
								gsap.to(".tt-phc-count span", { duration: 0.1, autoAlpha: 0, ease: Power2.easeIn });
								gsap.to($phcCounter, { duration: 0.1, autoAlpha: 1, ease:Power2.easeOut });
							}

						});

						// Slides total count
						var $phcTotalCount = $ttPortfolioHoverCarousel.find(".swiper-slide").not(".swiper-slide-duplicate").length;
						$(".tt-phc-counter-separator").after('<span class="tt-phc-total">' + $phcTotalCount);

					}

				}

			});

		});
	}


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-portfolio-hover-carousel.default', elportCarouselshover);
    });

   
})(jQuery);