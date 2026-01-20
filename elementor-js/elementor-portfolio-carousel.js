(function($) {
    var elportCarousel = function ($scope, $) {

    // =======================================================================================
	// Portfolio carousel (full screen carousel)
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-portfolio-carousel").length) {
		$(".tt-portfolio-carousel").each(function() {
			var $ttPortfolioCarousel = $(this);

			// Data attributes
			// ================
			var $dataMousewheel = $ttPortfolioCarousel.data("mousewheel");
			var $dataKeyboard = $ttPortfolioCarousel.data("keyboard");
			var $dataSimulateTouch = $ttPortfolioCarousel.data("simulate-touch");
			var $dataGrabCursor = $ttPortfolioCarousel.data("grab-cursor");
			var $dataAutoplay = $ttPortfolioCarousel.data("autoplay") ? { delay: $ttPortfolioCarousel.data("autoplay"),} : $ttPortfolioCarousel.data("autoplay");
			var $dataLoop = $ttPortfolioCarousel.data("loop") ? { loopedSlides: 100, } : $ttPortfolioCarousel.data("loop"); // Not recommended!

			if ($ttPortfolioCarousel.is("[data-speed]")) {
				var $dataSpeed = $ttPortfolioCarousel.data("speed"); // speed for larger screens
			} else {
				var $dataSpeed = 1200; // speed for larger screens (by default) 
			}

			if ($ttPortfolioCarousel.is("[data-pagination-type]")) {
				var $dataPaginationType = $ttPortfolioCarousel.data("pagination-type");
			} else {
				var $dataPaginationType = "fraction"; // by default (bullets/fraction/progressbar)
			}

			// Init Swiper
			// =============
			var $ttPortfolioCarouselSwiper = new Swiper ($ttPortfolioCarousel.find(".swiper")[0], {
				// Parameters
				direction: "horizontal",
				slidesPerView: "auto",
				spaceBetween: 0,
				resistanceRatio: 0.85,
				longSwipesRatio: 0.3,
				shortSwipes: true,
				centeredSlides: true,
				watchSlidesVisibility: true, // Needed for lazy loading
				preventInteractionOnTransition: false, // No actions during transition
				speed: 900, // Slider speed for smaller screens (when window width is 1024px or smaller)
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				autoplay: $dataAutoplay,
				simulateTouch: $dataSimulateTouch,
				grabCursor: $dataGrabCursor,
				loop: $dataLoop, // Not recommended!

				lazy: {
					loadPrevNext: true,
				},

				breakpoints: {
					// When window width is 1025px or larger
					1025: {
						speed: $dataSpeed,
						lazy: {
							loadPrevNextAmount: 3, // Amount of next/prev slides to preload lazy images in.
						},
					}
				},

				// Pagination
				pagination: {
					el: ".tt-pc-pagination",
					type: $dataPaginationType,
					modifierClass: "tt-pc-pagination-",
					dynamicBullets: true,
					dynamicMainBullets: 1,
					clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: ".tt-pc-arrow-next",
					prevEl: ".tt-pc-arrow-prev",
					disabledClass: "tt-pc-arrow-disabled",
				},

				// Events
				on: {
					lazyImageReady: (swiper) => { // Lazy load + slidesPerView:"auto" fix.
						$ttPortfolioCarouselSwiper.update()
					},

					init: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// Active slide class (custom) on load
						$slideActive.addClass("tt-slide-active"); // Add class to active slide.

						// Carousel slide disabled (prev/next slide) on load
						$slideActive.prevAll().addClass("tt-pcs-disabled");
						$slideActive.nextAll().addClass("tt-pcs-disabled");

					},

					transitionStart: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// Active slide classes (custom).
						$slideActive.addClass("tt-slide-active"); // Add class to active slide.
						$slideActive.prev().addClass("tt-slide-active-start"); // Add class if active slide transition starts.
						$slideActive.next().addClass("tt-slide-active-start"); // Add class if active slide transition starts.

						// Carousel slide disabled (prev/next slide)
						$slideActive.prevAll().addClass("tt-pcs-disabled");
						$slideActive.removeClass("tt-pcs-disabled");
						$slideActive.nextAll().addClass("tt-pcs-disabled");

						// Play video
						$(".swiper-slide-active").find("video").each(function() {
							$(this).get(0).play();
						}); 

						// Disable nav arrow action.
						$(".tt-pc-arrow").addClass("tt-pc-arrow-disabled");

					},

					transitionEnd: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// Active slide classes (custom)
						$slideActive.prevAll().removeClass("tt-slide-active"); // Remove class if active slide transition ends.
						$slideActive.nextAll().removeClass("tt-slide-active"); // Remove class if active slide transition ends.
						$slideActive.prev().removeClass("tt-slide-active-start"); // Remove class if active slide transition ends.
						$slideActive.next().removeClass("tt-slide-active-start"); // Remove class if active slide transition ends.

						// Pause video
						$(".swiper-slide-prev").find("video").each(function() {
							$(this).get(0).pause();
						});
						
						$(".swiper-slide-next").find("video").each(function() {
							$(this).get(0).pause();
						});

						// Disable nav arrow action.
						$(".tt-pc-arrow").removeClass("tt-pc-arrow-disabled");

					}
				}
			});

			// Scale down animation on carousel click
			if ($ttPortfolioCarousel.attr("data-simulate-touch") == "true") {
				if ($ttPortfolioCarousel.hasClass("pc-scale-down")) {
					$ttPortfolioCarousel.find(".swiper").on("mousedown touchstart pointerdown", function(e) {
						if (e.which === 1) { // Affects the left mouse button only!
							gsap.to($ttPortfolioCarousel.find(".swiper-slide"), { duration: 0.7, scale: 0.9 });
						}
					});
					$("body").on("mouseup touchend pointerup mouseleave", function() {	
						gsap.to($ttPortfolioCarousel.find(".swiper-slide"), { duration: 0.7, scale: 1, clearProps: "scale" });
					});
				}
			}

			// Update slider when windows resize or orientation change 
			$(window).on("resize orientationchange", function() {
				setTimeout(function(){
					$ttPortfolioCarouselSwiper.update();
					$ttPortfolioCarousel.find(".swiper-wrapper").addClass("swtr-smooth");
				}, $dataSpeed);

				setTimeout(function(){
					$ttPortfolioCarousel.find(".swiper-wrapper").removeClass("swtr-smooth");
				}, $dataSpeed + $dataSpeed);
			});
		});
	}


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-portfolio-carousel.default', elportCarousel);
    });

   
})(jQuery);