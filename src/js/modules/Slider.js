import LoopSlider from "./LoopSlider";
import Swiper from "swiper";
import {
	Pagination,
	Autoplay,
	Navigation,
	EffectFade,
	Thumbs,
	Scrollbar,
} from "swiper/modules";

$(document).ready(() => {
	const homeBannerSlider = new Swiper(".home-banner-slider .swiper", {
		modules: [Autoplay, EffectFade, Navigation],
		slidesPerView: 1,
		effect: "fade",
		speed: 1000,
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: ".home-banner-slider .swiper-btn-next",
			prevEl: ".home-banner-slider .swiper-btn-prev",
		},
	});

	const partnerSlider = new Swiper(".partner-slider .swiper", {
		modules: [Autoplay, Navigation],
		slidesPerView: 2.5,
		spaceBetween: 16,
		loop: true,
		speed: 2000,
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: ".partner-slider .swiper-btn-next",
			prevEl: ".partner-slider .swiper-btn-prev",
		},
		breakpoints: {
			576: {
				slidesPerView: 4.5,
			},
			768: {
				slidesPerView: 5.5,
			},
			1024: {
				slidesPerView: 6,
				spaceBetween: 24,
			},
		},
	});

	$(".news-slider").each((index, element) => {
		const swiper = $(element).find(".swiper")[0];
		const swiperPrev = $(element).find(".swiper-btn-prev")[0];
		const swiperNext = $(element).find(".swiper-btn-next")[0];
		const newsSlider = new Swiper(swiper, {
			modules: [Autoplay, Navigation],
			slidesPerView: "auto",
			spaceBetween: 0,
			loop: true,
			speed: 1000,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: swiperNext,
				prevEl: swiperPrev,
			},
		});
	});

	const catalogueSlider = new Swiper(".catalogue-slider .swiper", {
		modules: [Autoplay, Navigation],
		slidesPerView: "1.5",
		spaceBetween: 4,
		loop: true,
		speed: 1000,
		centeredSlides: true,
		breakpoints: {
			576: {
				slidesPerView: "2.5",
			},
			1024: {
				slidesPerView: "5",
			},
		},
	});

	const singleSlider = new LoopSlider(".single-slider", {
		1024: {
			spaceBetween: 40,
			slidesPerView: 1,
			centeredSlides: false,
		},
	});

	const doubleSlider = new LoopSlider(".double-slider", {
		576: {
			spaceBetween: 20,
			slidesPerView: 1.5,
		},
		1024: {
			spaceBetween: 40,
			slidesPerView: 2,
			centeredSlides: false,
		},
	});

	const tripleSlider = new LoopSlider(".triple-slider", {
		576: {
			spaceBetween: 20,
			slidesPerView: 2.5,
		},
		1024: {
			spaceBetween: 40,
			slidesPerView: 3,
			centeredSlides: false,
		},
	});

	const quadrupleSlider = new LoopSlider(".quadruple-slider", {
		576: {
			spaceBetween: 20,
			slidesPerView: 2.5,
		},
		768: {
			spaceBetween: 20,
			slidesPerView: 3.5,
		},
		1024: {
			spaceBetween: 40,
			slidesPerView: 4,
			centeredSlides: false,
		},
	});
});
