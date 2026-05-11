import Swiper from "swiper";
import { Navigation, Thumbs, EffectFade } from "swiper/modules";

const productDetailSlider = () => {
	const productDetailThumbnailSlider = new Swiper(
		".product-detail-thumbnail .swiper",
		{
			spaceBetween: 10,
			slidesPerView: 3.5,
			observer: true,
			observeParents: true,
			slideToClickedSlide: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			breakpoints: {
				768: {
					slidesPerView: 4.5,
				},
				1024: {
					slidesPerView: 5,
					direction: "vertical",
				},
			},
		}
	);
	const productDetailImageSlider = new Swiper(
		".product-detail-images .swiper",
		{
			modules: [Navigation, Thumbs, EffectFade],
			observer: true,
			observeParents: true,
			thumbs: {
				swiper: productDetailThumbnailSlider,
			},
			navigation: {
				nextEl: ".product-detail-images .swiper-btn-next",
				prevEl: ".product-detail-images .swiper-btn-prev",
			},
			effect: "fade",
			on: {
				slideChange: function () {
					let activeIndex = this.activeIndex + 1;

					let nextSlide = $(
						`.product-detail-thumbnail .swiper-slide:nth-child(${
							activeIndex + 1
						})`
					);
					let prevSlide = $(
						`.product-detail-thumbnail .swiper-slide:nth-child(${
							activeIndex - 1
						})`
					);

					if (
						nextSlide &&
						!nextSlide.hasClass("swiper-slide-visible")
					) {
						this.thumbs.swiper.slideNext();
					} else if (
						prevSlide &&
						!prevSlide.hasClass("swiper-slide-visible")
					) {
						this.thumbs.swiper.slidePrev();
					}
				},
			},
		}
	);

	window.productDetailImageSlider = productDetailImageSlider;
};

$(document).ready(function () {
	productDetailSlider();
});
