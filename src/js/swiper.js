jQuery(function ($) {
	const mainSlider = '.main-sldier'; //メインスライダーのクラス名
	const thumbSlider = '.thumbnail-sldier'; //サムネイルスライダーのクラス名
	const mainSlides = document.getElementsByClassName('main-slide'); //メインスライダーのslideのクラス名
	const thumbSlides = document.getElementsByClassName('thumbnail-slide'); //サムネイルスライダーのslideのクラス名
	let slideChangePermit = false;

	const mainSwiper = new Swiper(mainSlider, {
		loop: true,
		spaceBetween: 10,
		loopedSlides: mainSlides.length,
		slideToClickedSlide: false,
		clickable: false,
	});

	const thumbSwiper = new Swiper(thumbSlider, {
		speed: 1500,
		autoplay: {
			delay: 2000,
		},
		// autoplay: false,
		slideToClickedSlide: true,
		spaceBetween: 10,
		slidesPerView: 4,
		centeredSlides: true,
		loop: true,
		loopedSlides: mainSlides.length,
		controller: {
			control: mainSwiper,
		},
	});

	for (let i = 0; i < thumbSlides.length; i++) {
		thumbSlides[i].addEventListener(
			'click',
			() => {
				setTimeout(() => {
					thumbSwiper.autoplay.start();
				}, 3000);
			},
			false
		);
	}

	// mainSwiper.on('touchEnd', () => {
	// 	slideChangePermit = true;
	// });

	// mainSwiper.on('slideChange', () => {
	// 	if (slideChangePermit) {
	// 		const current = mainSwiper.activeIndex;
	// 		thumbSwiper.slideTo(current, 300, true);
	// 		setTimeout(() => {
	// 			thumbSwiper.autoplay.start();
	// 			slideChangePermit = false;
	// 		}, 3000);
	// 	}
	// });
});
