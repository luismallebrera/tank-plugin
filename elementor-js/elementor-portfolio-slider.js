(function($) {
    var portSlider = function ($scope, $) {

    // ==========================================================
	// Detect mobile device and add class "is-mobile" to </body>
	// ==========================================================

	// Detect mobile device (Do not remove!!!)
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Nokia|Opera Mini/i.test(navigator.userAgent) ? true : false;

	// Add class "is-mobile" to </body>
	if(isMobile) {
		$("body").addClass("is-mobile");
	}
	
	// =======================================================================================
	// Portfolio slider (full screen slider)
	// Source: https://swiperjs.com/
	// =======================================================================================

	// =======================================================================================
	// Portfolio slider (full screen slider)
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-portfolio-slider").length) {
		$(".tt-portfolio-slider").each(function() {
			var $ttPortfolioSlider = $(this);

			// Data attributes
			// ================
			var $dataMousewheel = $ttPortfolioSlider.data("mousewheel");
			var $dataKeyboard = $ttPortfolioSlider.data("keyboard");
			var $dataSimulateTouch = $ttPortfolioSlider.data("simulate-touch");
			var $dataGrabCursor = $ttPortfolioSlider.data("grab-cursor");
			var $dataParallax = $ttPortfolioSlider.data("parallax");
			var $dataDirection = $ttPortfolioSlider.data("direction");
			var $dataEffect = $ttPortfolioSlider.data("effect");
			var $dataAutoplay = $ttPortfolioSlider.data("autoplay") ? { delay: $ttPortfolioSlider.data("autoplay"),} : $ttPortfolioSlider.data("autoplay");
			var $dataLoop = $ttPortfolioSlider.data("loop") ? { loopedSlides: 100, } : $ttPortfolioSlider.data("loop"); // Not recommended!

			if ($ttPortfolioSlider.is("[data-speed]")) {
				var $dataSpeed = $ttPortfolioSlider.data("speed");
			} else {
				var $dataSpeed = 900; // by default
			}

			if ($ttPortfolioSlider.is("[data-pagination-type]")) {
				var $dataPaginationType = $ttPortfolioSlider.data("pagination-type");
			} else {
				var $dataPaginationType = "fraction"; // by default (bullets/fraction/progressbar)
			}

			// Init Swiper
			// =============
			var $ttPortfolioSliderSwiper = new Swiper ($ttPortfolioSlider.find(".swiper")[0], {
				// Parameters
				direction: $dataDirection,
				effect: $dataEffect,
				speed: 600, // slider speed for smaller screens (when window width is 1024px or smaller)
				parallax: $dataParallax,
				resistanceRatio: 0,
				longSwipesRatio: 0.02,
				preloadImages: false, // Needed for lazy loading
				preventInteractionOnTransition: true, // No actions during transition
				autoplay: $dataAutoplay,
				mousewheel: $dataMousewheel,
				keyboard: $dataKeyboard,
				simulateTouch: $dataSimulateTouch,
				grabCursor: $dataGrabCursor,
				loop: $dataLoop, // Not recommended!

				breakpoints: {
					// when window width is 1025px or larger
					1025: {
						speed: $dataSpeed,
					}
				},

				// Lazy loading
				lazy: {
					loadPrevNext: true,
					loadOnTransitionStart: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: $ttPortfolioSlider.find(".tt-ps-nav-arrow-next")[0],
					prevEl: $ttPortfolioSlider.find(".tt-ps-nav-arrow-prev")[0],
					disabledClass: "tt-ps-nav-arrow-disabled",
				},

				// Pagination
				pagination: {
					el: $ttPortfolioSlider.find(".tt-ps-nav-pagination")[0],
					type: $dataPaginationType,
					modifierClass: "tt-ps-nav-pagination-",
					dynamicBullets: true,
					dynamicMainBullets: 1,
					clickable: true,
				},

				// Events
				on: {
					init: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// Play video on load
						$slideActive.find("video").each(function() {
							$(this).get(0).play();
						}); 

						// Portfolio slider caption on load
						// ---------------------------------
						// Portfolio slider caption title (if contains link or not)
						if ($ttPortfolioSlider.find(".tt-ps-caption-title").find("a").length) {
							$ttPortfolioSlider.find(".tt-ps-caption-title a").text($slideActive.attr("data-title"));
							$ttPortfolioSlider.find(".tt-ps-caption-title a").attr("href", $slideActive.attr("data-url"));
						} else {
							$ttPortfolioSlider.find(".tt-ps-caption-title").text($slideActive.attr("data-title"));
						}

						// Portfolio slider caption category on load
						$ttPortfolioSlider.find(".tt-ps-caption-category").text($slideActive.attr("data-category"));
					},

					transitionStart: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// If slider image is light
						setTimeout(function(){
							if ($slideActive.hasClass("psi-image-is-light")) {
								$("body").addClass("psi-light-image-on");
							} else {
								$("body").removeClass("psi-light-image-on");
							}
						}, 400);

						// Play video
						$slideActive.find("video").each(function() {
							$(this).get(0).play();
						}); 

						// Animate portfolio slider caption
						gsap.fromTo($ttPortfolioSlider.find(".tt-psc-elem"), { autoAlpha: 1, y: 0 }, { duration: 0.25, autoAlpha: 0, y: -30, stagger: 0.15, ease: Power1.easeIn });
					},

					transitionEnd: function () {

						var $this = this;
						var $slideActive = $($this.slides[$this.activeIndex]);

						// Pause video
						$slideActive.prevAll().find("video").each(function() {
							$(this).get(0).pause();
						});
						$slideActive.nextAll().find("video").each(function() {
							$(this).get(0).pause();
						});

						// Portfolio slider caption
						// -------------------------
						// Portfolio slider caption title (if contains link or not)
						if ($ttPortfolioSlider.find(".tt-ps-caption-title").find("a").length) {
							$ttPortfolioSlider.find(".tt-ps-caption-title a").text($slideActive.attr("data-title"));
							$ttPortfolioSlider.find(".tt-ps-caption-title a").attr("href", $slideActive.attr("data-url"));
						} else {
							$ttPortfolioSlider.find(".tt-ps-caption-title").text($slideActive.attr("data-title"));
						}

						// Portfolio slider caption category
						$ttPortfolioSlider.find(".tt-ps-caption-category").text($slideActive.attr("data-category"));

						// Animate portfolio slider caption
						gsap.fromTo($ttPortfolioSlider.find(".tt-psc-elem"), { autoAlpha: 0, y: 30 }, { duration: 0.25, autoAlpha: 1, y: 0, stagger: 0.15, ease: Power1.easeOut });
					}
				}
			});


			// Parallax effect on mouse move (no effect on mobile devices!)
			// ------------------------------
			if(!isMobile) {
				if ($ttPortfolioSlider.data("parallax-mouse-move")) {
					gsap.set($ttPortfolioSlider.find(".tt-psi-image"), { scale: 1.05 });

					$ttPortfolioSlider.mousemove(function(e) {
						parallaxIt(e, $ttPortfolioSlider.find(".tt-psi-image"), -25); // Parallax element
						parallaxIt(e, $ttPortfolioSlider.find(".tt-ps-caption-inner"), -35); // Parallax element
					});

					function parallaxIt(e, target, movement) {
						var $this = $ttPortfolioSlider
						var relX = e.pageX - $this.offset().left;
						var relY = e.pageY - $this.offset().top;

						gsap.to(target, {
							duration: 1,
							x: (relX - $this.width() / 2) / $this.width() * movement,
							y: (relY - $this.height() / 2) / $this.height() * movement
						});
					}
				}
			}

		});
	}


    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tank-portfolio-slider.default', portSlider);
    });

   
})(jQuery);