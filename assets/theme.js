/* =================================================================
* Tank Plugin - Elementor Widgets JS
* Contains only code required for Elementor widgets
================================================================= */

(function ($) {
	'use strict';

	// Detect mobile device
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Nokia|Opera Mini/i.test(navigator.userAgent) ? true : false;
	if(isMobile) {
		$("body").addClass("is-mobile");
	}

	// =======================================================================================
	// Portfolio slider (full screen slider)
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-portfolio-slider").length) {
		$(".tt-portfolio-slider").each(function() {
			var $ttPortfolioSlider = $(this);
			var $dataAutoplay = $ttPortfolioSlider.data("autoplay");
			var $dataSimulateTouch = $ttPortfolioSlider.data("simulate-touch");
			var $dataMousewheel = $ttPortfolioSlider.data("mousewheel");
			var $dataKeyboard = $ttPortfolioSlider.data("keyboard");
			var $dataGrabCursor = $ttPortfolioSlider.data("grab-cursor");
			var $dataPaginationType = $ttPortfolioSlider.data("pagination-type");
			var $ttPortfolioSliderSwiper = new Swiper ($ttPortfolioSlider.find(".swiper")[0], {
				direction: "horizontal",
				loop: false,
				centeredSlides: false,
				grabCursor: $dataGrabCursor,
				resistance: true,
				resistanceRatio: 0,
				speed: 1200,
				autoplay: $dataAutoplay,
				simulateTouch: $dataSimulateTouch,
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				pagination: {
					el: ".tt-ps-nav-pagination",
					type: $dataPaginationType,
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-ps-nav-next",
					prevEl: ".tt-ps-nav-prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					}
				},
				on: {
					init: function () {
						setTimeout(function () {
							if ($(".psi-video").length) {
								var $psiVideo = $(".swiper-slide-active .psi-video").get(0);
								$psiVideo.play();
							}
						}, 200);
					},
					slideChange: function() {
						if ($(".psi-video").length) {
							$(".psi-video").each(function() {
								var $psiVideo = $(this).get(0);
								$psiVideo.pause();
							});
							var activeSlideVideo = $(".swiper-slide-active .psi-video").get(0);
							if (activeSlideVideo) {
								activeSlideVideo.play();
							}
						}
					},
				},
			});
		});
	}

	// =======================================================================================
	// Portfolio carousel
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-portfolio-carousel").length) {
		$(".tt-portfolio-carousel").each(function() {
			var $ttPortfolioCarousel = $(this);
			var $dataAutoplay = $ttPortfolioCarousel.data("autoplay");
			var $dataSimulateTouch = $ttPortfolioCarousel.data("simulate-touch");
			var $dataMousewheel = $ttPortfolioCarousel.data("mousewheel");
			var $dataKeyboard = $ttPortfolioCarousel.data("keyboard");
			var $dataGrabCursor = $ttPortfolioCarousel.data("grab-cursor");
			var $dataPaginationType = $ttPortfolioCarousel.data("pagination-type");
			var $ttPortfolioCarouselSwiper = new Swiper ($ttPortfolioCarousel.find(".swiper")[0], {
				direction: "horizontal",
				centeredSlides: false,
				grabCursor: $dataGrabCursor,
				resistance: true,
				resistanceRatio: 0,
				speed: 900,
				autoplay: $dataAutoplay,
				simulateTouch: $dataSimulateTouch,
				keyboard: $dataKeyboard,
				mousewheel: $dataMousewheel,
				pagination: {
					el: ".tt-pc-pagination",
					type: $dataPaginationType,
					clickable: true,
				},
				navigation: {
					nextEl: ".tt-pc-nav-next",
					prevEl: ".tt-pc-nav-prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
						spaceBetween: 30,
					},
					768: {
						slidesPerView: "auto",
						spaceBetween: 0,
					}
				},
				on: {
					init: function () {
						setTimeout(function () {
							if ($(".pci-video").length) {
								var $pciVideo = $(".swiper-slide-active .pci-video").get(0);
								$pciVideo.play();
							}
						}, 200);
					},
					slideChange: function() {
						if ($(".pci-video").length) {
							$(".pci-video").each(function() {
								var $pciVideo = $(this).get(0);
								$pciVideo.pause();
							});
							var activeSlideVideo = $(".swiper-slide-active .pci-video").get(0);
							if (activeSlideVideo) {
								activeSlideVideo.play();
							}
						}
					},
				},
			});
		});
	}

	// =======================================================================================
	// Portfolio hover carousel
	// Source: https://swiperjs.com/
	// =======================================================================================

	if ($(".tt-portfolio-hover-carousel").length) {
		$("body").addClass("tt-portfolio-hover-carousel-on");
		$(".tt-portfolio-hover-carousel").each(function() {
			var $ttPortfolioHoverCarousel = $(this);
			var $dataSimulateTouch = $ttPortfolioHoverCarousel.data("simulate-touch");
			var $dataGrabCursor = $ttPortfolioHoverCarousel.data("grab-cursor");
			var $dataLoop = $ttPortfolioHoverCarousel.data("loop") ? { loopedSlides: 100, } : $ttPortfolioHoverCarousel.data("loop");
			var $ttPortfolioHoverCarouselSwiper = new Swiper ($ttPortfolioHoverCarousel.find(".swiper")[0], {
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
			});
		});
	}

	// =================================================================================
	// Content carousel
	// Source: https://swiperjs.com/
	// =================================================================================

	if ($(".tt-content-carousel").length) {
		$(".tt-content-carousel").each(function() {
			var $ttContentCarousel = $(this);
			var $ttContentCarouselSwiper = new Swiper ($ttContentCarousel.find(".swiper")[0], {
				direction: "horizontal",
				loop: false,
				centeredSlides: false,
				grabCursor: true,
				resistance: true,
				resistanceRatio: 0,
				speed: 900,
				autoplay: false,
				simulateTouch: true,
				spaceBetween: 80,
				pagination: {
					el: $ttContentCarousel.find(".tt-cc-pagination")[0],
					clickable: true,
				},
				navigation: {
					nextEl: $ttContentCarousel.find(".tt-cc-nav-next")[0],
					prevEl: $ttContentCarousel.find(".tt-cc-nav-prev")[0],
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
						spaceBetween: 30,
					},
					768: {
						slidesPerView: "auto",
						spaceBetween: 60,
					},
					1025: {
						slidesPerView: "auto",
						spaceBetween: 80,
					}
				},
			});
		});
	}

	// ===========================================================================
	// Testimonials slider
	// Source: https://swiperjs.com/
	// ===========================================================================

	if ($(".tt-testimonials-slider").length) {
		$(".tt-testimonials-slider").each(function() {
			var $ttTestimonialsSlider = $(this);
			var $ttTestimonialsSliderSwiper = new Swiper ($ttTestimonialsSlider.find(".swiper")[0], {
				direction: "horizontal",
				loop: false,
				centeredSlides: false,
				grabCursor: true,
				resistance: true,
				resistanceRatio: 0,
				speed: 900,
				autoplay: false,
				simulateTouch: true,
				spaceBetween: 80,
				pagination: {
					el: $ttTestimonialsSlider.find(".tt-ts-pagination")[0],
					clickable: true,
				},
				navigation: {
					nextEl: $ttTestimonialsSlider.find(".tt-ts-nav-next")[0],
					prevEl: $ttTestimonialsSlider.find(".tt-ts-nav-prev")[0],
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
						spaceBetween: 30,
					},
					768: {
						slidesPerView: "auto",
						spaceBetween: 60,
					},
					1025: {
						slidesPerView: "auto",
						spaceBetween: 80,
					}
				},
			});
		});
	}

	// ================================================================
	// Isotope
	// Source: https://isotope.metafizzy.co/
	// ================================================================

	if ($(".isotope-items-wrap").length) {
		$(".isotope-items-wrap").each(function() {
			var $isoItemsWrap = $(this);
			var $isoItemsWrapInit = $isoItemsWrap.imagesLoaded(function() {
				$isoItemsWrapInit.isotope({
					itemSelector: ".isotope-item",
					layoutMode: "packery",
					percentPosition: true,
					packery: {
						columnWidth: ".isotope-item"
					}
				});
			});
			$(".ttgr-cat-list").on("click", "a", function() {
				var filterValue = $(this).attr("data-filter");
				$isoItemsWrapInit.isotope({ filter: filterValue });
				$(".ttgr-cat-list a").removeClass("active");
				$(this).addClass("active");
				return false;
			});
			$(".ttgr-cat-classic-list").on("click", "a", function() {
				var filterValue = $(this).attr("data-filter");
				$isoItemsWrapInit.isotope({ filter: filterValue });
				$(".ttgr-cat-classic-list a").removeClass("active");
				$(this).addClass("active");
				return false;
			});
		});
	}

	// ================================================================
	// lightGallery (lightbox plugin)
	// Source: http://sachinchoolur.github.io/lightGallery/
	// ================================================================

	if ($(".tt-gallery, .lg-trigger-icon, .lg-trigger").length) {
		$(".tt-gallery, .lg-trigger-icon, .lg-trigger").lightGallery({
			thumbnail: false,
			animateThumb: false,
			showThumbByDefault: false,
			download: false,
			share: false,
			subHtmlSelectorRelative: true,
		});
	}

	// ================================================================
	// Portfolio Grid Categories
	// ================================================================

	if ($(".ttgr-cat-nav").length) {
		$(".ttgr-cat-nav").appendTo("#body-inner");
		$(".ttgr-cat-trigger").on("click", function(e) {
			e.preventDefault();
			$("body").addClass("ttgr-cat-nav-open");
			if ($("body").hasClass("ttgr-cat-nav-open")) {
				gsap.to(".portfolio-grid-item", { duration: 0.3, scale: 0.9 });
				gsap.to(".pgi-caption, .ttgr-cat-trigger", { duration: 0.3, autoAlpha: 0 });
				$(".ttgr-cat-nav").off("click");
				var tl_ttgrIn = gsap.timeline({
					onComplete: function() {
						ttCatNavClose();
					}
				});
				tl_ttgrIn.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 1 });
				tl_ttgrIn.from(".ttgr-cat-list > li", { duration: 0.3, y: 80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeOut, clearProps:"all" });
				$(".ttgr-cat-nav a").on("click", function() {
					var tl_ttgrClose = gsap.timeline();
					 tl_ttgrClose.to(".ttgr-cat-list > li", { duration: 0.3, y: -80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeIn, clearProps:"all" });
					 tl_ttgrClose.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 0, clearProps:"all" }, "-=0.1");
					 tl_ttgrClose.to(".portfolio-grid-item", { duration: 0.3, scale: 1, clearProps:"all" }, "-=0.4");
					 tl_ttgrClose.to(".pgi-caption, #page-header, .ttgr-cat-trigger", { duration: 0.3, autoAlpha: 1, clearProps:"all" }, "-=0.4");
					 tl_ttgrClose.eventCallback("onComplete", function() {
						$("body").removeClass("ttgr-cat-nav-open");
					 });
				});
			}
		});
		function ttCatNavClose() {
			$(".ttgr-cat-nav").on("click", function() {
				$("body").removeClass("ttgr-cat-nav-open");
				var tl_ttgrClose = gsap.timeline();
				 tl_ttgrClose.to(".ttgr-cat-list > li", { duration: 0.3, y: -80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeIn, clearProps:"all" });
				 tl_ttgrClose.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 0, clearProps:"all" }, "-=0.1");
				 tl_ttgrClose.to(".portfolio-grid-item", { duration: 0.3, scale: 1, clearProps:"all" }, "-=0.4");
				 tl_ttgrClose.to(".pgi-caption, #page-header, .ttgr-cat-trigger", { duration: 0.3, autoAlpha: 1, clearProps:"all" }, "-=0.4");
			});
		}
		$(".ttgr-cat-close").on("click", function() {
			$("body").removeClass("ttgr-cat-nav-open");
			var tl_ttgrClose = gsap.timeline();
			 tl_ttgrClose.to(".ttgr-cat-list > li", { duration: 0.3, y: -80, autoAlpha: 0, stagger: 0.05, ease: Power2.easeIn, clearProps:"all" });
			 tl_ttgrClose.to(".ttgr-cat-nav", { duration: 0.3, autoAlpha: 0, clearProps:"all" }, "-=0.1");
			 tl_ttgrClose.to(".portfolio-grid-item", { duration: 0.3, scale: 1, clearProps:"all" }, "-=0.4");
			 tl_ttgrClose.to(".pgi-caption, #page-header, .ttgr-cat-trigger", { duration: 0.3, autoAlpha: 1, clearProps:"all" }, "-=0.4");
		});
	}

	// ================================================================
	// tt-Accordion
	// ================================================================

	if ($(".tt-accordion").length) {
		$(".tt-accordion").each(function() {
			var $ttAccordion = $(this);
			var $ttAccordionToggle = $ttAccordion.find(".tt-accordion-heading");
			$ttAccordionToggle.on("click", function() {
				if($(this).hasClass("active")) {
					$(this).removeClass("active").next().slideUp();
				} else {
					$(this).addClass("active").next().slideDown().parent().siblings().find(".tt-accordion-content").slideUp().prev().removeClass("active");
				}
				return false;
			});
		});
	}

	// ================================================================
	// tt-Tabs
	// ================================================================

	if ($(".tt-tabs").length) {
		$(".tt-tabs").each(function() {
			$(this).find(".tt-tabs-nav li:first").addClass("active");
			$(this).find(".tt-tabs-item").hide().filter(":first").show();
			$(this).find(".tt-tabs-nav li a").on("click", function(e){
				e.preventDefault();
				var $parentItem = $(this).parent();
				var $actItem = $(this).attr("href");
				$parentItem.addClass("active").siblings().removeClass("active");
				$($actItem).show().siblings(".tt-tabs-item").hide();
			});
		});
	}

	// ================================================================
	// Defer videos (Youtube, Vimeo)
	// ================================================================

	function init() {
		var vidDefer = document.getElementsByTagName("iframe");
		for (var i=0; i<vidDefer.length; i++) {
			if(vidDefer[i].getAttribute("data-src")) {
				vidDefer[i].setAttribute("src",vidDefer[i].getAttribute("data-src"));
			}
		}
	}
	if (window.addEventListener) {
		window.addEventListener("load", init, false);
	} else if (window.attachEvent) {
		window.attachEvent("onload", init);
	} else {
		window.onload = init;
	}

})(jQuery);
