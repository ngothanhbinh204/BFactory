import Swiper from "swiper";
import { Pagination, Autoplay, Navigation } from "swiper/modules";

class LoopSlider {
	constructor(sliderClass, breakpoints, options = {}) {
		this.sliderClass = sliderClass;
		this.breakpoints = breakpoints;
		this.options = options;
		this.init();
	}

	init() {
		$(this.sliderClass).each((index, element) => {
			const $this = $(element);
			const swiperContainer = $this.find(".swiper")[0];
			const swiperBtnPrev = $this.find(".swiper-btn-prev")[0];
			const swiperBtnNext = $this.find(".swiper-btn-next")[0];
			const swiperPagination = $this.find(".swiper-pagination")[0];
			const isLoop = $this.data("loop");
			const isAutoplay = $this.data("autoplay");
			const isDisableOnInteraction = $this.data("disable-on-interaction");
			const swiper = new Swiper(swiperContainer, {
				modules: [Pagination, Autoplay, Navigation],
				slidesPerView: 1.25,
				spaceBetween: 12,
				watchSlidesVisibility: true,
				navigation: {
					prevEl: swiperBtnPrev,
					nextEl: swiperBtnNext,
				},
				pagination: {
					el: swiperPagination,
					clickable: true,
				},
				speed: 800,
				loop: isLoop ? true : false,
				autoplay: Number(isAutoplay)
					? {
							delay: isAutoplay,
							disableOnInteraction: isDisableOnInteraction
								? true
								: false,
					  }
					: false,
				breakpoints: this.breakpoints,
				...this.options,
			});
		});
	}
}

export default LoopSlider;
