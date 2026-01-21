/* =================================================================
 * Tank Plugin - Elementor Widgets JavaScript
 * Minimal version - Only Elementor widget functionality
 ================================================================= */

(function ($) {
	'use strict';

	// Register GSAP plugins
	gsap.registerPlugin(ScrollTrigger);

	// ==========================================================
	// Detect mobile device and add class "is-mobile" to </body>
	// ==========================================================

	// Detect mobile device (Do not remove!!!)
	const isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	// Add class "is-mobile" to </body>
	if (isMobile.any()) {
		$("body").addClass("is-mobile");
	}

	// ================================================
	// Portfolio slider (full screen slider)
	// ================================================

	if ($(".tt-portfolio-slider").length) {

		$('.tt-portfolio-slider').each(function() {

			// Get container
			let $psContainer = $(this);

			// Get wrapper (from container)
			let $psWrapper = $psContainer.find(".swiper-wrapper");

			// Get slides (from wrapper)
			let $psSlides = $psWrapper.find(".swiper-slide");
			let $psCount = $psSlides.length;

			// Get data attributes (from container)
			let $dataLoop = $psContainer.data("loop");
			let $dataAutoplay = $psContainer.data("autoplay");
			let $dataSpeed = $psContainer.data("speed");
			let $dataSlidesPerView = $psContainer.data("slides-per-view");
			let $dataSpaceInBetween = $psContainer.data("space-between");
			let $dataSimulateTouch = $psContainer.data("simulate-touch");
			let $dataGrabCursor = $psContainer.data("grab-cursor");
			let $dataMousewheel = $psContainer.data("mousewheel");
			let $dataKeyboard = $psContainer.data("keyboard");
			let $dataAllowTouchMove = $psContainer.data("allow-touch-move");

			// Disable autoplay by default
			var psAutoplay = false;

			// Init portfolio slider
			const psSwiper = new Swiper($psContainer[0], {
				slidesPerView: $dataSlidesPerView,
				loop: $dataLoop,
				speed: $dataSpeed,
				grabCursor: $dataGrabCursor,
				allowTouchMove: $dataAllowTouchMove,
				spaceBetween: $dataSpaceInBetween,
				autoHeight: false,
				autoplay: psAutoplay,
				simulateTouch: $dataSimulateTouch,
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				pagination: {
					el: ".tt-portfolio-slider-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-ps-nav-next",
					prevEl: ".tt-ps-nav-prev",
				},
			});

			// Enable autoplay if it is true (for videos it is fake autoplay, to wait until video stops)
			if ($dataAutoplay == true) {
				if ($psContainer.find(".tt-video-wrap").length) {
					$psContainer.addClass("tt-ps-with-video");
					psSwiper.autoplay.stop();

					$psSlides.each(function(i) {
						let self = $(this);

						if (self.find(".tt-video-wrap").length) {
							self.find(".plyr__poster").on("click", function() {
								psSwiper.autoplay.stop();
							});
							self.find("video, iframe").on("play playing", function() {
								psSwiper.autoplay.stop();
							});
							self.find("video, iframe").on("pause ended", function() {
								if (self.hasClass("swiper-slide-active")) {
									setTimeout(function() {
										psSwiper.slideNext();
									}, 700);
								}
							});
						}
					});

				} else {
					psSwiper.autoplay.start();
				}
			}
		});
	}

	// ===================================================
	// Portfolio carousel (full screen carousel)
	// ===================================================

	if ($(".tt-portfolio-carousel").length) {

		$('.tt-portfolio-carousel').each(function() {

			// Get container
			let $pcContainer = $(this);

			// Get wrapper (from container)
			let $pcWrapper = $pcContainer.find(".swiper-wrapper");

			// Get slides (from wrapper)
			let $pcSlides = $pcWrapper.find(".swiper-slide");
			let $pcCount = $pcSlides.length;

			// Get data attributes (from container)
			let $dataLoop = $pcContainer.data("loop");
			let $dataAutoplay = $pcContainer.data("autoplay");
			let $dataSpeed = $pcContainer.data("speed");
			let $dataSlidesPerView = $pcContainer.data("slides-per-view");
			let $dataSpaceInBetween = $pcContainer.data("space-between");
			let $dataSimulateTouch = $pcContainer.data("simulate-touch");
			let $dataGrabCursor = $pcContainer.data("grab-cursor");
			let $dataMousewheel = $pcContainer.data("mousewheel");
			let $dataKeyboard = $pcContainer.data("keyboard");
			let $dataAllowTouchMove = $pcContainer.data("allow-touch-move");
			let $dataCenteredSlides = $pcContainer.data("centered-slides");

			// Disable autoplay by default
			var pcAutoplay = false;

			// Init portfolio carousel
			const pcSwiper = new Swiper($pcContainer[0], {
				slidesPerView: $dataSlidesPerView,
				centeredSlides: $dataCenteredSlides,
				loop: $dataLoop,
				speed: $dataSpeed,
				grabCursor: $dataGrabCursor,
				allowTouchMove: $dataAllowTouchMove,
				spaceBetween: $dataSpaceInBetween,
				autoHeight: false,
				autoplay: pcAutoplay,
				simulateTouch: $dataSimulateTouch,
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				pagination: {
					el: ".tt-portfolio-carousel-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-pc-nav-next",
					prevEl: ".tt-pc-nav-prev",
				},
			});

			// Enable autoplay if it is true (for videos it is fake autoplay, to wait until video stops)
			if ($dataAutoplay == true) {
				if ($pcContainer.find(".tt-video-wrap").length) {
					$pcContainer.addClass("tt-pc-with-video");
					pcSwiper.autoplay.stop();

					$pcSlides.each(function(i) {
						let self = $(this);

						if (self.find(".tt-video-wrap").length) {
							self.find(".plyr__poster").on("click", function() {
								pcSwiper.autoplay.stop();
							});
							self.find("video, iframe").on("play playing", function() {
								pcSwiper.autoplay.stop();
							});
							self.find("video, iframe").on("pause ended", function() {
								if (self.hasClass("swiper-slide-active")) {
									setTimeout(function() {
										pcSwiper.slideNext();
									}, 700);
								}
							});
						}
					});

				} else {
					pcSwiper.autoplay.start();
				}
			}
		});
	}

	// ===========================================================
	// Portfolio hover carousel (full screen carousel)
	// ===========================================================

	if ($(".tt-portfolio-hover-carousel").length) {

		$('.tt-portfolio-hover-carousel').each(function() {

			// Get container
			let $phcContainer = $(this);

			// Get wrapper (from container)
			let $phcWrapper = $phcContainer.find(".swiper-wrapper");

			// Get slides (from wrapper)
			let $phcSlides = $phcWrapper.find(".swiper-slide");
			let $phcCount = $phcSlides.length;

			// Get data attributes (from container)
			let $dataLoop = $phcContainer.data("loop");
			let $dataSpeed = $phcContainer.data("speed");
			let $dataSlidesPerView = $phcContainer.data("slides-per-view");
			let $dataSpaceInBetween = $phcContainer.data("space-between");
			let $dataCenteredSlides = $phcContainer.data("centered-slides");

			// Init portfolio hover carousel
			const phcSwiper = new Swiper($phcContainer[0], {
				slidesPerView: $dataSlidesPerView,
				centeredSlides: $dataCenteredSlides,
				loop: $dataLoop,
				speed: $dataSpeed,
				spaceBetween: $dataSpaceInBetween,
				autoHeight: false,
				simulateTouch: false,
				allowTouchMove: false,
			});

		});
	}

	// ============================
	// Content carousel
	// ============================

	if ($(".tt-content-carousel").length) {

		$('.tt-content-carousel').each(function() {

			// Get container
			let $ccContainer = $(this);

			// Get wrapper (from container)
			let $ccWrapper = $ccContainer.find(".swiper-wrapper");

			// Get slides (from wrapper)
			let $ccSlides = $ccWrapper.find(".swiper-slide");
			let $ccCount = $ccSlides.length;

			// Get data attributes (from container)
			let $dataLoop = $ccContainer.data("loop");
			let $dataAutoplay = $ccContainer.data("autoplay");
			let $dataSpeed = $ccContainer.data("speed");
			let $dataSlidesPerView = $ccContainer.data("slides-per-view");
			let $dataSpaceInBetween = $ccContainer.data("space-between");
			let $dataSimulateTouch = $ccContainer.data("simulate-touch");
			let $dataGrabCursor = $ccContainer.data("grab-cursor");
			let $dataMousewheel = $ccContainer.data("mousewheel");
			let $dataKeyboard = $ccContainer.data("keyboard");
			let $dataAllowTouchMove = $ccContainer.data("allow-touch-move");
			let $dataCenteredSlides = $ccContainer.data("centered-slides");

			// Disable autoplay by default
			var ccAutoplay = false;

			// Enable autoplay
			if ($dataAutoplay == true) {
				ccAutoplay = {
					delay: $dataAutoplay,
					disableOnInteraction: false,
				};
			}

			// Init content carousel
			const ccSwiper = new Swiper($ccContainer[0], {
				slidesPerView: $dataSlidesPerView,
				centeredSlides: $dataCenteredSlides,
				loop: $dataLoop,
				speed: $dataSpeed,
				grabCursor: $dataGrabCursor,
				allowTouchMove: $dataAllowTouchMove,
				spaceBetween: $dataSpaceInBetween,
				autoHeight: false,
				autoplay: ccAutoplay,
				simulateTouch: $dataSimulateTouch,
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				pagination: {
					el: ".tt-content-carousel-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-cc-nav-next",
					prevEl: ".tt-cc-nav-prev",
				},
			});
		});
	}

	// ============================
	// Testimonials slider
	// ============================

	if ($(".tt-testimonials-slider").length) {

		$('.tt-testimonials-slider').each(function() {

			// Get container
			let $tsContainer = $(this);

			// Get wrapper (from container)
			let $tsWrapper = $tsContainer.find(".swiper-wrapper");

			// Get slides (from wrapper)
			let $tsSlides = $tsWrapper.find(".swiper-slide");
			let $tsCount = $tsSlides.length;

			// Get data attributes (from container)
			let $dataLoop = $tsContainer.data("loop");
			let $dataAutoplay = $tsContainer.data("autoplay");
			let $dataSpeed = $tsContainer.data("speed");
			let $dataSpaceInBetween = $tsContainer.data("space-between");
			let $dataSimulateTouch = $tsContainer.data("simulate-touch");
			let $dataGrabCursor = $tsContainer.data("grab-cursor");

			// Disable autoplay by default
			var tsAutoplay = false;

			// Enable autoplay
			if ($dataAutoplay == true) {
				tsAutoplay = {
					delay: $dataAutoplay,
					disableOnInteraction: false,
				};
			}

			// Init testimonials slider
			const tsSwiper = new Swiper($tsContainer[0], {
				slidesPerView: 1,
				loop: $dataLoop,
				speed: $dataSpeed,
				grabCursor: $dataGrabCursor,
				spaceBetween: $dataSpaceInBetween,
				autoHeight: false,
				autoplay: tsAutoplay,
				simulateTouch: $dataSimulateTouch,
				pagination: {
					el: ".tt-testimonials-pagination",
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-ts-nav-next",
					prevEl: ".tt-ts-nav-prev",
				},
			});
		});
	}

	// ====================
	// Isotope
	// ====================

	if ($(".tt-grid").length || $(".tt-masonry").length) {

		const $container = $(".tt-portfolio-grid");
		const $containerGallery = $(".tt-gallery");

		$container.each(function() {

			let $this = $(this);

			const gutter = parseInt($container.attr("data-gutter"), 10);

			$container.imagesLoaded(function() {
				$container.isotope({
					itemSelector: ".tt-grid-item",
					layoutMode: "packery",
					percentPosition: true,
					packery: {
						columnWidth: ".tt-grid-sizer",
						gutter: gutter
					}
				});
			});
		});

		$containerGallery.each(function() {

			let $this = $(this);

			const gutterGallery = parseInt($containerGallery.attr("data-gutter"), 10);

			$containerGallery.imagesLoaded(function() {
				$containerGallery.isotope({
					itemSelector: ".tt-gallery-item",
					layoutMode: "packery",
					percentPosition: true,
					packery: {
						columnWidth: ".tt-grid-sizer",
						gutter: gutterGallery
					}
				});
			});
		});
	}

	// ====================
	// lightGallery
	// ====================

	if ($(".tt-Gallery, .tt-lightbox").length) {

		$(".tt-Gallery").lightGallery({
			selector: ".lg-trigger",
			thumbnail: true,
			share: false,
			fullScreen: true,
			autoplay: false,
			autoplayControls: false,
			actualSize: false,
		});

		$(".tt-lightbox").lightGallery({
			thumbnail: false,
			share: false,
			fullScreen: true,
			autoplay: false,
			autoplayControls: false,
			actualSize: false,
		});
	}

	// =====================================================

	// =====================================================
	// Portfolio grid categories filter show/hide on scroll
	// =====================================================

	if ($(".tt-grid-categories").length) {

		var $ttgCatTriggerWrap = $(".ttgr-cat-trigger-wrap");

		if ($ttgCatTriggerWrap.hasClass("ttgr-cat-fixed")) {
			$ttgCatTriggerWrap.appendTo("#body-inner");

			// Show/Hide trigger on page scroll
			ScrollTrigger.create({
				trigger: "#portfolio-grid",
				start: "top bottom",
				end: "bottom 75%",
				scrub: true,
				markers: false,

				onEnter: () => ttgCatShow(),
				onLeave: () => ttgCatHide(),
				onEnterBack: () => ttgCatShow(),
				onLeaveBack: () => ttgCatHide(),
			});

			function ttgCatShow() {
				gsap.to($ttgCatTriggerWrap, { duration: 0.4, autoAlpha: 1, scale: 1, ease:Power2.easeOut });
			}
			function ttgCatHide() {
				gsap.to($ttgCatTriggerWrap, { duration: 0.4, autoAlpha: 0, scale: 0.9, ease:Power2.easeOut });
			}

		} else {

			// Hide trigger before it reaches the top when page scroll
			gsap.to($ttgCatTriggerWrap, {
				yPercent: 70,
				autoAlpha: 0,
				ease: "none",
				scrollTrigger: {
					trigger: $ttgCatTriggerWrap,
					start: "top 250px",
					end: "100px 250px",
					scrub: true,
					markers: false
				},
			});

		}
	}

	// ==========================================
	// Portfolio grid categories navigation overlay
	// ==========================================

	if ($(".ttgr-cat-nav").length) {
		$(".ttgr-cat-nav").appendTo("#body-inner");

		// On category trigger click

	$(".ttgr-cat-trigger").on("click", function(e) {
		e.preventDefault();
		$("body").addClass("ttgr-cat-nav-open");
		
		// Scroll to top then show navigation
		if (typeof lenis !== "undefined") {
			lenis.scrollTo(0, {
				duration: 0.6,
				onComplete: function() {
					showCatNavigation();
					setTimeout(function() {
						lenis.stop();
					}, 600);
				}
			});
		} else {
			showCatNavigation();
		}

		function showCatNavigation() {
			if ($("body").hasClass("ttgr-cat-nav-open")) {
				gsap.to(".portfolio-grid-item", { duration: 0.3, scale: 0.9 });
				gsap.to(".pgi-caption, .ttgr-cat-trigger-wrap", { duration: 0.3, autoAlpha: 0 });

				// Make "ttgr-cat-nav" unclickable
				$(".ttgr-cat-nav").off("click");

				// Categories step in animations
				var tl_ttgrIn = gsap.timeline({
					onComplete: function() {
						ttCatNavClose();
					}
				});
				tl_ttgrIn.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 1 });
				tl_ttgrIn.from(".ttgr-cat-list > li", { duration: 0.3, y: 80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeOut, clearProps:"all" });

				// On category link click
				$(".ttgr-cat-nav a")
				.not('[target="_blank"]')
				.not('[href^="#"]')
				.not('[href^="mailto"]')
				.not('[href^="tel"]')
				.on('click', function() {
					gsap.to(".ttgr-cat-list > li", { duration: 0.3, y: -80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeIn });
				});
			}
		}
	});
		function ttCatNavClose() {
			$(".ttgr-cat-nav").on("click", function() {
				if (typeof lenis !== "undefined") lenis.start();
				$("body").removeClass("ttgr-cat-nav-open");

				// Categories step out animations
				var tl_ttgrClose = gsap.timeline();
				tl_ttgrClose.to(".ttgr-cat-list > li", { duration: 0.3, y: -80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeIn });
				tl_ttgrClose.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 0, clearProps:"all" }, "+=0.2");
				tl_ttgrClose.to(".portfolio-grid-item", { duration: 0.3, scale: 1, clearProps:"all" }, "-=0.4");
				tl_ttgrClose.to(".pgi-caption, #page-header, .ttgr-cat-trigger-wrap", { duration: 0.3, autoAlpha: 1 }, "-=0.4");
				tl_ttgrClose.to(".ttgr-cat-list > li", { clearProps:"all" });
			});
		}
	}
	// Portfolio grid categories filter
	// ========================================

	if ($(".tt-grid-categories").length) {

		$(".ttgr-cat-list li a, .ttgr-cat-trigger").on("click", function(e) {
			e.preventDefault();
			let $this = $(this);
			let filterValue = $this.attr("data-filter");
			$(".tt-portfolio-grid").isotope({ filter: filterValue });
			$(".ttgr-cat-list li a").removeClass("active");
			$this.addClass("active");

			if ($(".ttgr-cat-trigger-wrap").length) {
				$(".ttgr-cat-list").removeClass("show");
			}
		});

		$(".ttgr-cat-trigger").on("click", function(e) {
			e.preventDefault();
			$(".ttgr-cat-list").toggleClass("show");
		});
	}

	// ========================================
	// tt-Accordion
	// ========================================

	if ($(".tt-accordion").length) {

		$(".tt-accordion").each(function() {
			let $ttAccordion = $(this);
			let $accItem = $ttAccordion.find(".tt-accordion-heading");

			$accItem.on("click", function() {
				$(this).toggleClass("active").next(".tt-accordion-content").slideToggle(400);
				$(this).parent(".tt-accordion-item").siblings().find(".tt-accordion-heading").removeClass("active");
				$(this).parent(".tt-accordion-item").siblings().find(".tt-accordion-content").slideUp(400);
			});
		});
	}

	// ============================
	// tt-Tabs
	// ============================

	if ($(".tt-tabs").length) {

		$(".tt-tabs").each(function() {
			$(this).find(".tt-tab-item").first().addClass("active");
			$(this).find(".tt-tab-content").first().addClass("active");
		});

		$(".tt-tab-item").on("click", function() {
			let $tabItemParent = $(this).parent(".tt-tabs");
			let $tabItemIndex = $(this).index();
			$tabItemParent.find(".tt-tab-item, .tt-tab-content").removeClass("active");
			$(this).addClass("active");
			$tabItemParent.find(".tt-tab-content").eq($tabItemIndex).addClass("active");
		});
	}

	// ===============================
	// Defer videos (Youtube, Vimeo)
	// ===============================

	if ($("#page-content iframe[data-src], #page-header iframe[data-src]").length) {
		$("#page-content iframe[data-src], #page-header iframe[data-src]").each(function() {
			$(this).attr("src", $(this).attr("data-src"));
		});
	}

})(jQuery);
