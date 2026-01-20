(function($) {
    var contentCarousel = function ($scope, $) {


    	// =======================================================================================
		// Content carousel
		// Source: https://swiperjs.com/
		// =======================================================================================

		if ($(".tt-content-carousel").length) {
			$(".tt-content-carousel").each(function() {
				var $ttContentCarousel = $(this);

				// Data attributes
				// ================
				var $dataSimulateTouch = $ttContentCarousel.data("simulate-touch");
				var $autoplay = $ttContentCarousel.data("autoplay") ? { delay: $ttContentCarousel.data("autoplay"), } : $ttContentCarousel.data("autoplay");
				var $dataLoop = $ttContentCarousel.data("loop") ? { loopedSlides: 100, } : $ttContentCarousel.data("loop");

				if ($ttContentCarousel.is("[data-speed]")) {
					var $dataSpeed = $ttContentCarousel.data("speed");
				} else {
					var $dataSpeed = 900; // by default
				}

				if ($ttContentCarousel.is("[data-pagination-type]")) {
					var $dataPaginationType = $ttContentCarousel.data("pagination-type");
				} else {
					var $dataPaginationType = "bullets"; // by default (bullets/fraction/progressbar)
				}

				// Init Swiper
				// =============
				var $ttContentCarouselSwiper = new Swiper($ttContentCarousel.find(".swiper")[0], {
					// Parameters
					direction: "horizontal",
					slidesPerView: "auto",
					spaceBetween: 0,
					centeredSlides: true,
					longSwipesRatio: 0.3,
					mousewheel: false,
					keyboard: false,
					watchSlidesVisibility: true, // Needed for lazy loading
					preventInteractionOnTransition: false, // No actions during transition
					simulateTouch: $dataSimulateTouch,
					grabCursor: $dataSimulateTouch,
					speed: $dataSpeed,
					autoplay: $autoplay,
					loop: $dataLoop,

					lazy: {
						loadPrevNext: true,
					},

					breakpoints: {
						// when window width is 1025px or larger
						1025: {
							lazy: {
								loadPrevNextAmount: 3, // Amount of next/prev slides to preload lazy images in.
							},
						}
					},

					// Navigation (arrows)
					navigation: {
						nextEl: $ttContentCarousel.find(".tt-cc-nav-next")[0],
						prevEl: $ttContentCarousel.find(".tt-cc-nav-prev")[0],
						disabledClass: "tt-cc-nav-arrow-disabled",
					},

					// Pagination
					pagination: {
						el: ".tt-cc-pagination",
						type: $dataPaginationType,
						modifierClass: "tt-cc-pagination-",
						dynamicBullets: true,
						dynamicMainBullets: 1,
						clickable: true,
					},

					// Events
					on: {
						lazyImageReady: (swiper) => { // Lazy load + slidesPerView:"auto" fix.
							$ttContentCarouselSwiper.update()
						},

						transitionStart: function () {

							// Play video
							$(".swiper-slide-active").find("video").each(function() {
								$(this).get(0).play();
							}); 

						},

						transitionEnd: function () {

							// Pause video
							$(".swiper-slide-prev").find("video").each(function() {
								$(this).get(0).pause();
							});
							
							$(".swiper-slide-next").find("video").each(function() {
								$(this).get(0).pause();
							});

						}
					}
				});


				// Image parallax and zoom in 
				// ===========================
				var $ccImageParallax = $ttContentCarousel.find(".tt-cc-image-parallax");

				// Add wrap <div>.
				$ccImageParallax.wrap('<div class="tt-cc-image-parallax-wrap"><div class="tt-cc-image-parallax-inner"></div></div>');

				// Add css.
				$ccImageParallax.css({ "transform": "scale(1.2", "transform-origin": "50% 100%" });
				$(".tt-cc-image-parallax-wrap").css({ "overflow": "hidden" });
				
				var $ccIpWrap = $ccImageParallax.parents(".tt-cc-image-parallax-wrap");
				var $ccIpInner = $ccIpWrap.find(".tt-cc-image-parallax-inner");

				// Images parallax
				gsap.to($ccImageParallax, {
					yPercent: 30,
					ease: "none",
					scrollTrigger: {
						trigger: $ccIpWrap,
						start: "top bottom",
						end: "bottom top",
						scrub: true,
						markers: false,
					},
				});

				// Images zoom in
				let tl_ccZoomIn = gsap.timeline({
					scrollTrigger: {
						trigger: $ccIpWrap,
						start: "top 90%",
						markers: false,
					}
				});
				tl_ccZoomIn.from($ccIpInner, { duration: 1.5, autoAlpha: 0, scale: 1.2, ease: Power2.easeOut, clearProps:"all" });


				// Scale down animation on carousel click
				// =======================================
				if ($ttContentCarousel.attr("data-simulate-touch") == "true") {
					if ($ttContentCarousel.hasClass("cc-scale-down")) {
						$ttContentCarousel.find(".swiper-wrapper").on("mousedown touchstart pointerdown", function(e) {
							if (e.which === 1) { // Affects the left mouse button only!
								gsap.to($ttContentCarousel.find(".tt-content-carousel-item"), { duration: 0.7, scale: 0.9 });
							}
						});
						$("body").on("mouseup touchend pointerup mouseleave", function() {	
							gsap.to($ttContentCarousel.find(".tt-content-carousel-item"), { duration: 0.7, scale: 1, clearProps: "scale" });
						});
					}
				}

			});
		}


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-img-carousel.default', contentCarousel);
    });

   
})(jQuery);